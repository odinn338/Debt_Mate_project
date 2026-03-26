@include('layout.sidebar')

<main class="main-content">

    <header class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-file-invoice-dollar"></i> إدارة الديون</h1>
            <p>عرض وإدارة جميع الديون والالتزامات المالية</p>
        </div>
        <button class="btn-primary" id="addDebtBtn">
            <i class="fas fa-plus"></i>
            إضافة دين جديد
        </button>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <section class="debts-stats">
        <div class="debt-stat-card total">
            <div class="stat-icon"><i class="fas fa-list"></i></div>
            <div class="stat-info">
                <h3>إجمالي الديون</h3>
                <p class="stat-number">{{ $debts->count() }}</p>
                <span class="stat-label">دين مسجل</span>
            </div>
        </div>
        <div class="debt-stat-card active">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>ديون نشطة</h3>
                <p class="stat-number">{{ $debts->whereIn('status', ['pending', 'partial'])->count() }}</p>
                <span class="stat-label">قيد السداد</span>
            </div>
        </div>
        <div class="debt-stat-card paid">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>ديون مسددة</h3>
                <p class="stat-number">{{ $debts->where('status', 'paid')->count() }}</p>
                <span class="stat-label">تم سدادها بالكامل</span>
            </div>
        </div>
        <div class="debt-stat-card overdue">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <h3>ديون متأخرة</h3>
                <p class="stat-number">{{ $debts->where('status', 'overdue')->count() }}</p>
                <span class="stat-label">تحتاج انتباه</span>
            </div>
        </div>
    </section>

    {{-- Debts Grid --}}
    <section class="debts-container grid-view" id="debtsContainer">

        @forelse($debts as $debt)
        <div class="debt-card" data-status="{{ $debt->status }}">
            <div class="debt-card-header">
                <div class="debt-category">
                    <i class="fas fa-file-invoice"></i>
                    <span>{{ $debt->type == 'owed_by_me' ? 'عليّ' : 'لي' }}</span>
                </div>
                <div class="debt-status {{ $debt->status }}">
                    @if($debt->status == 'paid')
                        <i class="fas fa-check-circle"></i> مسدد
                    @elseif($debt->status == 'overdue')
                        <i class="fas fa-exclamation-circle"></i> متأخر
                    @elseif($debt->status == 'partial')
                        <i class="fas fa-circle"></i> جزئي
                    @else
                        <i class="fas fa-circle"></i> نشط
                    @endif
                </div>
            </div>

            <h3 class="debt-title">{{ $debt->title }}</h3>

            <div class="debt-amount">
                <span class="amount-label">المبلغ الإجمالي</span>
                <span class="amount-value">{{ number_format($debt->amount, 0) }} ج.م</span>
            </div>

            <div class="debt-progress">
                <div class="progress-info">
                    <span>المسدد: {{ number_format($debt->paid_amount, 0) }} ج.م</span>
                    <span>{{ $debt->payment_percentage }}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $debt->payment_percentage }}%;"></div>
                </div>
            </div>

            @if($debt->due_date)
            <div class="debt-details">
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <span>الاستحقاق: {{ $debt->due_date->format('d M Y') }}</span>
                </div>
            </div>
            @endif

            <div class="debt-actions">
                @if($debt->status !== 'paid')
                    {{-- زر سداد كامل --}}
                    <form method="POST" action="{{ route('payments.store') }}"
                          onsubmit="return confirm('تأكيد سداد المبلغ المتبقي {{ number_format($debt->remaining_amount, 0) }} ج.م ؟')">
                        @csrf
                        <input type="hidden" name="debt_id"      value="{{ $debt->id }}">
                        <input type="hidden" name="amount"        value="{{ $debt->remaining_amount }}">
                        <input type="hidden" name="payment_date"  value="{{ date('Y-m-d') }}">
                        <input type="hidden" name="note"          value="سداد كامل من صفحة الديون">
                        <button type="submit" class="btn-action btn-pay" style="width:100%">
                            <i class="fas fa-money-bill"></i>
                            سداد كامل
                        </button>
                    </form>
                @else
                    <span class="btn-action" style="text-align:center;width:100%;color:green">
                        <i class="fas fa-check-circle"></i> تم السداد
                    </span>
                @endif

                {{-- زر حذف --}}
                <form method="POST" action="{{ route('debts.destroy', $debt->id) }}"
                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الدين؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding: 60px; color: #888; grid-column: 1/-1">
            <i class="fas fa-inbox" style="font-size:3rem; margin-bottom:10px"></i>
            <p>لا توجد ديون مسجلة بعد</p>
        </div>
        @endforelse

    </section>
</main>

{{-- Modal إضافة دين --}}
<div class="modal" id="addDebtModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-plus-circle"></i> إضافة دين جديد</h2>
            <button class="modal-close" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="modal-body" method="POST" action="{{ route('debts.store') }}">
            @csrf
            <div class="form-group">
                <label>عنوان الدين <span class="required">*</span></label>
                <input type="text" name="title" placeholder="مثال: قسط البنك الشهري" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>المبلغ الإجمالي <span class="required">*</span></label>
                    <input type="number" name="amount" placeholder="0" min="1" required>
                </div>
                <div class="form-group">
                    <label>النوع <span class="required">*</span></label>
                    <select name="type" required>
                        <option value="">اختر النوع</option>
                        <option value="owed_by_me">عليّ (أنا المدين)</option>
                        <option value="owed_to_me">لي (أنا الدائن)</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>تاريخ الاستحقاق</label>
                    <input type="date" name="due_date">
                </div>
            </div>

            <div class="form-group">
                <label>الوصف</label>
                <textarea name="description" rows="3" placeholder="أي ملاحظات إضافية..."></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" id="cancelBtn">إلغاء</button>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    حفظ الدين
                </button>
            </div>
        </form>
    </div>
</div>

@include('layout.footer')
