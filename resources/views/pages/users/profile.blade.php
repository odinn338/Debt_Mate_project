@include('layout.sidebar')

<main class="main-content">

    <!-- Header -->
    <header class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-user"></i> الملف الشخصي</h1>
            <p>معلوماتك الشخصية وإحصائياتك المالية</p>
        </div>
    </header>

    <!-- Profile Cover -->
    {{-- <section class="profile-cover">
        <div class="profile-header-content">
            <div class="profile-avatar-wrapper">
                <div class="profile-avatar">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=522B5B&color=FBE4D8&size=200&bold=true&font-size=0.4"
                         alt="Profile Picture">
                </div>
            </div>
            <div class="profile-info">
                <h2>{{ auth()->user()->name }}</h2>
                <p class="profile-role">
                    <i class="fas fa-user-tag"></i>
                    {{ auth()->user()->role == 'creditor' ? 'دائن' : 'مدين' }}
                </p>
                <p class="profile-email">
                    <i class="fas fa-envelope"></i>
                    {{ auth()->user()->email }}
                </p>
                <p class="profile-join-date">
                    <i class="fas fa-calendar"></i>
                    انضم في {{ auth()->user()->created_at->translatedFormat('F Y') }}
                </p>
            </div>
        </div>
    </section> --}}

    <!-- Profile Stats -->
    <section class="profile-stats">
        <div class="stat-box">
            <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
            <div class="stat-details">
                <h3>{{ auth()->user()->debts->count() }}</h3>
                <p>إجمالي الديون</p>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-details">
                <h3>{{ auth()->user()->debts->where('status', 'paid')->count() }}</h3>
                <p>ديون مسددة</p>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-details">
                <h3>{{ auth()->user()->debts->whereIn('status', ['pending', 'partial'])->count() }}</h3>
                <p>ديون نشطة</p>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-icon"><i class="fas fa-wallet"></i></div>
            <div class="stat-details">
                <h3>{{ number_format(auth()->user()->payments->sum('amount'), 0) }}</h3>
                <p>إجمالي المدفوع (ج.م)</p>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <div class="profile-content-grid">

        <!-- Left Column -->
        <div class="profile-left-column">

            <!-- Personal Information -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle"></i> المعلومات الشخصية</h3>
                </div>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-user"></i> الاسم الكامل
                        </span>
                        <span class="info-value">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-phone"></i> رقم الهاتف
                        </span>
                        <span class="info-value">{{ auth()->user()->phone ?? '—' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-envelope"></i> البريد الإلكتروني
                        </span>
                        <span class="info-value">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-user-tag"></i> نوع الحساب
                        </span>
                        <span class="info-value">
                            {{ auth()->user()->role == 'creditor' ? 'دائن' : 'مدين' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-calendar"></i> تاريخ الانضمام
                        </span>
                        <span class="info-value">
                            {{ auth()->user()->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="profile-right-column">

            <!-- Recent Payments Timeline -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> آخر الدفعات</h3>
                    <a href="{{ route('payments') }}" class="link-more">عرض الكل</a>
                </div>
                <div class="activity-timeline">
                    @forelse(auth()->user()->payments()->with('debt')->latest()->take(5)->get() as $payment)
                    <div class="timeline-item">
                        <div class="timeline-dot payment"></div>
                        <div class="timeline-content">
                            <h4>{{ $payment->debt->title }}</h4>
                            <p>تم سداد مبلغ {{ number_format($payment->amount, 0) }} ج.م</p>
                            <span class="timeline-time">{{ $payment->payment_date->diffForHumans() }}</span>
                        </div>
                    </div>
                    @empty
                    <p style="text-align:center; color:#888; padding: 20px">لا توجد دفعات بعد</p>
                    @endforelse
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-wallet"></i> الملخص المالي</h3>
                </div>
                <div class="financial-summary">
                    <div class="summary-item">
                        <span class="summary-label">إجمالي الديون</span>
                        <span class="summary-value">
                            {{ number_format(auth()->user()->debts->sum('amount'), 0) }} ج.م
                        </span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">إجمالي المدفوع</span>
                        <span class="summary-value positive">
                            {{ number_format(auth()->user()->debts->sum('paid_amount'), 0) }} ج.م
                        </span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">المتبقي للسداد</span>
                        <span class="summary-value">
                            {{ number_format(auth()->user()->debts->sum('amount') - auth()->user()->debts->sum('paid_amount'), 0) }} ج.م
                        </span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-item">
                        <span class="summary-label">عدد الدفعات المسجلة</span>
                        <span class="summary-value">
                            {{ auth()->user()->payments->count() }} دفعة
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>

@include('layout.footer')
