<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $debts = Debt::where('user_id', $user->id)->get();

        // Stats Cards
        $totalDebt      = $debts->sum('amount');
        $totalPaid      = $debts->sum('paid_amount');
        $totalRemaining = $totalDebt - $totalPaid;
        $overdueDebts   = $debts->where('status', 'overdue')->sum('amount');
        $payPercentage  = $totalDebt > 0 ? round(($totalPaid / $totalDebt) * 100, 1) : 0;

        // Recent Payments
        $recentPayments = Payment::where('user_id', $user->id)
            ->with('debt')
            ->latest()
            ->take(5)
            ->get();

        // Upcoming Debts
        $upcomingDebts = Debt::where('user_id', $user->id)
            ->whereNotIn('status', ['paid'])
            ->whereNotNull('due_date')
            ->orderBy('due_date')
            ->take(3)
            ->get();

        // Overdue Notifications
        $overdueNotifications = Debt::where('user_id', $user->id)
            ->where('status', 'overdue')
            ->get();

        // Monthly Chart Data — آخر 6 شهور
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $label = $month->translatedFormat('M Y');

            $monthDebts = Debt::where('user_id', $user->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');

            $monthPayments = Payment::where('user_id', $user->id)
                ->whereYear('payment_date', $month->year)
                ->whereMonth('payment_date', $month->month)
                ->sum('amount');

            $monthlyData[] = [
                'label'    => $label,
                'debts'    => (float) $monthDebts,
                'payments' => (float) $monthPayments,
            ];
        }

        return view('pages.index', compact(
            'totalDebt',
            'totalPaid',
            'totalRemaining',
            'overdueDebts',
            'payPercentage',
            'recentPayments',
            'upcomingDebts',
            'overdueNotifications',
            'monthlyData',
        ));
    }
}
