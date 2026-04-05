@include('layout.sidebar')

<main class="main-content">

    {{-- Header --}}
    <header class="dashboard-header">
        <div class="welcome-section">
            <h1>مرحباً بك، {{ auth()->user()->name }}! 👋</h1>
            <p>إليك نظرة سريعة على حالتك المالية اليوم</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('debts') }}" class="btn-primary">
                <i class="fas fa-plus"></i>
                إضافة دين جديد
            </a>
        </div>
    </header>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Statistics Cards --}}
    <section class="statistics-section">
        <div class="stat-card total-debt">
            <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            <div class="stat-content">
                <h3>إجمالي الديون</h3>
                <p class="stat-number">{{ number_format($totalDebt, 0) }} ج.م</p>
                <span class="stat-label">جميع الديون المسجلة</span>
            </div>
        </div>

        <div class="stat-card paid">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-content">
                <h3>المبالغ المسددة</h3>
                <p class="stat-number">{{ number_format($totalPaid, 0) }} ج.م</p>
                <span class="stat-label">تم سدادها بنجاح</span>
            </div>
            <div class="stat-trend">
                <i class="fas fa-check"></i>
                <span>{{ $payPercentage }}%</span>
            </div>
        </div>

        <div class="stat-card remaining">
            <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="stat-content">
                <h3>المتبقي للسداد</h3>
                <p class="stat-number">{{ number_format($totalRemaining, 0) }} ج.م</p>
                <span class="stat-label">يجب سداده</span>
            </div>
        </div>

        <div class="stat-card overdue">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-content">
                <h3>ديون متأخرة</h3>
                <p class="stat-number">{{ number_format($overdueDebts, 0) }} ج.م</p>
                <span class="stat-label">تحتاج انتباه فوري</span>
            </div>
            @if($overdueDebts > 0)
            <div class="stat-trend alert">
                <i class="fas fa-clock"></i>
                <span>عاجل</span>
            </div>
            @endif
        </div>
    </section>

    {{-- Charts --}}
    <section class="charts-section">

        {{-- Doughnut Chart --}}
        <div class="chart-card progress-chart">
            <div class="card-header">
                <h3>نسبة السداد</h3>
            </div>
            <div class="chart-container">
                <canvas id="progressChart"></canvas>
                <div class="chart-center-text">
                    <h2>{{ $payPercentage }}%</h2>
                    <p>مكتمل</p>
                </div>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-color paid"></span>
                    <span>مسدد ({{ number_format($totalPaid, 0) }} ج.م)</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color remaining"></span>
                    <span>متبقي ({{ number_format($totalRemaining, 0) }} ج.م)</span>
                </div>
            </div>
        </div>

        {{-- Line Chart --}}
        <div class="chart-card line-chart">
            <div class="card-header">
                <h3>تحليل السداد الشهري</h3>
            </div>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

    </section>

    {{-- Recent Transactions & Notifications --}}
    <section class="info-section">

        {{-- آخر المعاملات --}}
        <div class="info-card transactions">
            <div class="card-header">
                <h3>آخر المعاملات</h3>
                <a href="{{ route('payments') }}" class="link-more">
                    عرض الكل <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="transactions-list">
                @forelse($recentPayments as $payment)
                <div class="transaction-item">
                    <div class="transaction-icon paid">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="transaction-details">
                        <h4>{{ $payment->debt->title }}</h4>
                        <p>{{ $payment->payment_date->diffForHumans() }}</p>
                    </div>
                    <div class="transaction-amount paid">
                        - {{ number_format($payment->amount, 0) }} ج.م
                    </div>
                </div>
                @empty
                <div style="text-align:center; padding: 30px; color:#888">
                    <i class="fas fa-inbox" style="font-size:2rem; margin-bottom:8px"></i>
                    <p>لا توجد معاملات بعد</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- التنبيهات --}}
        <div class="info-card notifications">
            <div class="card-header">
                <h3>تنبيهات مهمة</h3>
                @if($overdueNotifications->count() > 0)
                    <span class="badge-count">{{ $overdueNotifications->count() }}</span>
                @endif
            </div>
            <div class="notifications-list">

                @forelse($overdueNotifications as $debt)
                <div class="notification-item urgent">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="notification-content">
                        <h4>دين متأخر!</h4>
                        <p>{{ $debt->title }} — {{ number_format($debt->remaining_amount, 0) }} ج.م</p>
                        <span class="time">
                            متأخر منذ {{ $debt->due_date->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @empty
                <div style="text-align:center; padding: 30px; color:#888">
                    <i class="fas fa-check-circle" style="font-size:2rem; color:green; margin-bottom:8px"></i>
                    <p>لا توجد تنبيهات</p>
                </div>
                @endforelse

                @foreach($upcomingDebts->take(2) as $debt)
                    @if($debt->due_date && $debt->due_date->diffInDays(now()) <= 7 && $debt->due_date->isFuture())
                    <div class="notification-item warning">
                        <div class="notification-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="notification-content">
                            <h4>اقتراب موعد السداد</h4>
                            <p>{{ $debt->title }} مستحق {{ $debt->due_date->diffForHumans() }}</p>
                            <span class="time">{{ number_format($debt->remaining_amount, 0) }} ج.م</span>
                        </div>
                    </div>
                    @endif
                @endforeach

            </div>
        </div>

    </section>

    {{-- Upcoming Payments --}}
    <section class="upcoming-section">
        <div class="section-header">
            <h2>الدفعات القادمة</h2>
        </div>

        <div class="upcoming-grid">
            @forelse($upcomingDebts as $debt)
            <div class="payment-card">
                <div class="payment-header">
                    <div class="payment-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                </div>
                <h3>{{ $debt->title }}</h3>
                <p class="payment-amount">{{ number_format($debt->remaining_amount, 0) }} ج.م</p>
                @if($debt->due_date)
                <div class="payment-date">
                    <i class="fas fa-calendar"></i>
                    <span>مستحق في {{ $debt->due_date->translatedFormat('d F Y') }}</span>
                </div>
                <div class="payment-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $debt->payment_percentage }}%;"></div>
                    </div>
                    <span>
                        @if($debt->due_date->isFuture())
                            {{ $debt->due_date->diffInDays(now()) }} يوم متبقي
                        @else
                            متأخر
                        @endif
                    </span>
                </div>
                @endif
                {{-- <a href="{{ route('debts') }}" class="btn-pay">سداد الآن</a> --}}
            </div>
            @empty
            <div style="text-align:center; padding: 40px; color:#888; grid-column:1/-1">
                <i class="fas fa-calendar-check" style="font-size:2rem; margin-bottom:8px"></i>
                <p>لا توجد دفعات قادمة</p>
            </div>
            @endforelse
        </div>
    </section>

</main>

{{-- تمرير البيانات للـ JavaScript --}}
<script>
    window.chartData = {
        paid:      {{ $totalPaid }},
        remaining: {{ $totalRemaining }},
        monthly: {
            labels:   {!! json_encode(array_column($monthlyData, 'label')) !!},
            debts:    {!! json_encode(array_column($monthlyData, 'debts')) !!},
            payments: {!! json_encode(array_column($monthlyData, 'payments')) !!},
        }
    };
</script>

@include('layout.footer')
