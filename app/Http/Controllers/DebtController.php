<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.debts', compact('debts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount'      => 'required|numeric|min:1',
            'due_date'    => 'nullable|date',
            'type'        => 'required|in:owed_by_me,owed_to_me',
        ], [
            'title.required'  => 'اسم الدين مطلوب',
            'amount.required' => 'المبلغ مطلوب',
            'amount.min'      => 'المبلغ يجب أن يكون أكبر من صفر',
            'type.required'   => 'نوع الدين مطلوب',
        ]);

        Debt::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'amount'      => $request->amount,
            'due_date'    => $request->due_date,
            'type'        => $request->type,
            'status'      => 'pending',
        ]);

        return redirect()->route('debts')->with('success', 'تم إضافة الدين بنجاح!');
    }

    public function destroy(Debt $debt)
    {
        if ($debt->user_id !== Auth::id()) {
            abort(403);
        }

        $debt->delete();

        return redirect()->route('debts')->with('success', 'تم حذف الدين بنجاح!');
    }
}
