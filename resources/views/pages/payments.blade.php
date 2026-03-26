@include('layout.sidebar')

<main class="main-content">

    <header class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-money-bill-wave"></i> عمليات السداد</h1>
            <p>تسجيل ومتابعة جميع عمليات السداد والدفعات</p>
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <section class="payment-stats">
        <div class="payment-stat-card">
            <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            <div class="stat-info">
                <h3>إجمالي المدفوع</h3>
                <p class="stat-number">{{ number_format($payments->sum('amount'), 0) }} ج.م</p>
            </div>
        </div>
        <div class="payment-stat-card">
            <div class="stat-icon"><i class="fas fa-calendar-month"></i></div>
            <div class="stat-info">
                <h3>هذا الشهر</h3>
                <p class="stat-number">
                    {{ number_format($payments->where('payment_date', '>=', now()->startOfMonth())->sum('amount'), 0) }} ج.م
                </p>
            </div>
        </div>
        <div class="payment-stat-card">
            <div class="stat-icon"><i class="fas fa-chart-bar"></i></div>
            <div class="stat-info">
                <h3>عدد الدفعات</h3>
                <p class="stat-number">{{ $payments->count() }}</p>
            </div>
        </div>
    </section>

    {{-- Table --}}
    <section class="payments-table-section">
        <h2>سجل المدفوعات</h2>
        <table class="payments-table">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>الدين</th>
                    <th>المبلغ</th>
                    <th>ملاحظة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date->format('d M Y') }}</td>
                    <td>{{ $payment->debt->title }}</td>
                    <td>{{ number_format($payment->amount, 0) }} ج.م</td>
                    <td>{{ $payment->note ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:40px; color:#888">
                        لا توجد دفعات مسجلة بعد
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</main>

@include('layout.footer')
