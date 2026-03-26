<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->with('debt')
            ->latest()
            ->get();

        return view('pages.payments', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'debt_id'      => 'required|exists:debts,id',
            'amount'       => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'note'         => 'nullable|string|max:255',
        ], [
            'debt_id.required'      => 'يجب اختيار الدين',
            'amount.required'       => 'المبلغ مطلوب',
            'payment_date.required' => 'تاريخ الدفع مطلوب',
        ]);

        $debt = Debt::where('id', $request->debt_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Payment::create([
            'debt_id'      => $debt->id,
            'user_id'      => Auth::id(),
            'amount'       => $request->amount,
            'payment_date' => $request->payment_date,
            'note'         => $request->note,
        ]);

        // تحديث المبلغ المدفوع في الدين
        $debt->paid_amount += $request->amount;
        $debt->save();
        $debt->updateStatus();

        return redirect()->route('payments')->with('success', 'تم تسجيل الدفعة بنجاح!');
    }
}
