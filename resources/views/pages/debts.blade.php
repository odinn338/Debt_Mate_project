@include('layout.sidebar')

    <main class="main-content">

        <!-- Header -->
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

        <!-- ============================================ -->
        <!-- Stats Overview - نظرة عامة -->
        <!-- ============================================ -->
        <section class="debts-stats">
            <div class="debt-stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-info">
                    <h3>إجمالي الديون</h3>
                    <p class="stat-number">15</p>
                    <span class="stat-label">دين مسجل</span>
                </div>
            </div>

            <div class="debt-stat-card active">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>ديون نشطة</h3>
                    <p class="stat-number">7</p>
                    <span class="stat-label">قيد السداد</span>
                </div>
            </div>

            <div class="debt-stat-card paid">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>ديون مسددة</h3>
                    <p class="stat-number">8</p>
                    <span class="stat-label">تم سدادها بالكامل</span>
                </div>
            </div>

            <div class="debt-stat-card overdue">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3>ديون متأخرة</h3>
                    <p class="stat-number">2</p>
                    <span class="stat-label">تحتاج انتباه</span>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- Filters & Search - الفلاتر والبحث -->
        <!-- ============================================ -->
        <section class="filters-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="البحث عن دين..." id="searchInput">
            </div>

            <div class="filter-group">
                <div class="filter-item">
                    <label>الحالة</label>
                    <select id="statusFilter">
                        <option value="all">الكل</option>
                        <option value="active">نشط</option>
                        <option value="paid">مسدد</option>
                        <option value="overdue">متأخر</option>
                    </select>
                </div>

                <div class="filter-item">
                    <label>الفئة</label>
                    <select id="categoryFilter">
                        <option value="all">الكل</option>
                        <option value="bank">بنوك</option>
                        <option value="bills">فواتير</option>
                        <option value="loans">قروض</option>
                        <option value="personal">شخصي</option>
                        <option value="other">أخرى</option>
                    </select>
                </div>

                <div class="filter-item">
                    <label>الترتيب</label>
                    <select id="sortFilter">
                        <option value="date-desc">الأحدث أولاً</option>
                        <option value="date-asc">الأقدم أولاً</option>
                        <option value="amount-desc">الأعلى مبلغاً</option>
                        <option value="amount-asc">الأقل مبلغاً</option>
                        <option value="due-date">تاريخ الاستحقاق</option>
                    </select>
                </div>

                <button class="btn-reset-filters" id="resetFilters">
                    <i class="fas fa-redo"></i>
                    إعادة تعيين
                </button>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- View Toggle - تبديل العرض -->
        <!-- ============================================ -->
        <section class="view-toggle-section">
            <div class="results-count">
                <span>عرض <strong>7</strong> من أصل <strong>15</strong> دين</span>
            </div>
            <div class="view-toggle">
                <button class="view-btn active" data-view="grid">
                    <i class="fas fa-th"></i>
                    شبكة
                </button>
                <button class="view-btn" data-view="list">
                    <i class="fas fa-list"></i>
                    قائمة
                </button>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- Debts Grid View - عرض الديون (شبكة) -->
        <!-- ============================================ -->
        <section class="debts-container grid-view" id="debtsContainer">

            <!-- Debt Card 1 -->
            <div class="debt-card" data-status="overdue" data-category="bank">
                <div class="debt-card-header">
                    <div class="debt-category bank">
                        <i class="fas fa-university"></i>
                        <span>بنك</span>
                    </div>
                    <div class="debt-status overdue">
                        <i class="fas fa-exclamation-circle"></i>
                        متأخر
                    </div>
                </div>
                <h3 class="debt-title">قسط البنك الشهري</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">24,000 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 12,000 ج.م</span>
                        <span>50%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 50%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>الاستحقاق: 10 فبراير 2026</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>متأخر بـ 5 أيام</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-pay">
                        <i class="fas fa-money-bill"></i>
                        سداد
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

            <!-- Debt Card 2 -->
            <div class="debt-card" data-status="active" data-category="bills">
                <div class="debt-card-header">
                    <div class="debt-category bills">
                        <i class="fas fa-file-invoice"></i>
                        <span>فواتير</span>
                    </div>
                    <div class="debt-status active">
                        <i class="fas fa-circle"></i>
                        نشط
                    </div>
                </div>
                <h3 class="debt-title">فاتورة الكهرباء</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">1,500 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 500 ج.م</span>
                        <span>33%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 33%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>الاستحقاق: 20 فبراير 2026</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>متبقي 8 أيام</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-pay">
                        <i class="fas fa-money-bill"></i>
                        سداد
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

            <!-- Debt Card 3 -->
            <div class="debt-card" data-status="active" data-category="bills">
                <div class="debt-card-header">
                    <div class="debt-category bills">
                        <i class="fas fa-wifi"></i>
                        <span>فواتير</span>
                    </div>
                    <div class="debt-status active">
                        <i class="fas fa-circle"></i>
                        نشط
                    </div>
                </div>
                <h3 class="debt-title">اشتراك الإنترنت</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">340 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 0 ج.م</span>
                        <span>0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>الاستحقاق: 28 فبراير 2026</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>متبقي 16 يوم</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-pay">
                        <i class="fas fa-money-bill"></i>
                        سداد
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

            <!-- Debt Card 4 -->
            <div class="debt-card" data-status="paid" data-category="loans">
                <div class="debt-card-header">
                    <div class="debt-category loans">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>قرض</span>
                    </div>
                    <div class="debt-status paid">
                        <i class="fas fa-check-circle"></i>
                        مسدد
                    </div>
                </div>
                <h3 class="debt-title">قرض شخصي</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">15,000 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 15,000 ج.م</span>
                        <span>100%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill complete" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>تم السداد: 5 يناير 2026</span>
                    </div>
                    <div class="detail-item success">
                        <i class="fas fa-trophy"></i>
                        <span>مسدد بالكامل</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-view">
                        <i class="fas fa-eye"></i>
                        عرض
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

            <!-- Debt Card 5 -->
            <div class="debt-card" data-status="active" data-category="loans">
                <div class="debt-card-header">
                    <div class="debt-category loans">
                        <i class="fas fa-car"></i>
                        <span>قرض</span>
                    </div>
                    <div class="debt-status active">
                        <i class="fas fa-circle"></i>
                        نشط
                    </div>
                </div>
                <h3 class="debt-title">قسط السيارة</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">120,000 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 42,000 ج.م</span>
                        <span>35%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 35%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>الاستحقاق: 1 مارس 2026</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>القسط الشهري: 3,500 ج.م</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-pay">
                        <i class="fas fa-money-bill"></i>
                        سداد
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

            <!-- Debt Card 6 -->
            <div class="debt-card" data-status="overdue" data-category="personal">
                <div class="debt-card-header">
                    <div class="debt-category personal">
                        <i class="fas fa-user"></i>
                        <span>شخصي</span>
                    </div>
                    <div class="debt-status overdue">
                        <i class="fas fa-exclamation-circle"></i>
                        متأخر
                    </div>
                </div>
                <h3 class="debt-title">دين لأحمد</h3>
                <div class="debt-amount">
                    <span class="amount-label">المبلغ الإجمالي</span>
                    <span class="amount-value">5,000 ج.م</span>
                </div>
                <div class="debt-progress">
                    <div class="progress-info">
                        <span>المسدد: 2,000 ج.م</span>
                        <span>40%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 40%;"></div>
                    </div>
                </div>
                <div class="debt-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>الاستحقاق: 5 فبراير 2026</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>متأخر بـ 7 أيام</span>
                    </div>
                </div>
                <div class="debt-actions">
                    <button class="btn-action btn-pay">
                        <i class="fas fa-money-bill"></i>
                        سداد
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                        حذف
                    </button>
                </div>
            </div>

        </section>

    </main>

    <!-- ============================================ -->
    <!-- Add Debt Modal - نافذة إضافة دين -->
    <!-- ============================================ -->
    <div class="modal" id="addDebtModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-plus-circle"></i> إضافة دين جديد</h2>
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="modal-body" id="addDebtForm">
                <div class="form-group">
                    <label>عنوان الدين <span class="required">*</span></label>
                    <input type="text" name="title" placeholder="مثال: قسط البنك الشهري" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>المبلغ الإجمالي <span class="required">*</span></label>
                        <input type="number" name="amount" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>الفئة <span class="required">*</span></label>
                        <select name="category" required>
                            <option value="">اختر الفئة</option>
                            <option value="bank">بنك</option>
                            <option value="bills">فواتير</option>
                            <option value="loans">قرض</option>
                            <option value="personal">شخصي</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>تاريخ الاستحقاق <span class="required">*</span></label>
                        <input type="date" name="due_date" required>
                    </div>
                    <div class="form-group">
                        <label>الأولوية</label>
                        <select name="priority">
                            <option value="low">منخفضة</option>
                            <option value="medium" selected>متوسطة</option>
                            <option value="high">عالية</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>الملاحظات</label>
                    <textarea name="notes" rows="3" placeholder="أي ملاحظات إضافية..."></textarea>
                </div>

                <div class="form-group checkbox-group">
                    <label>
                        <input type="checkbox" name="recurring">
                        <span>دين متكرر (شهري)</span>
                    </label>
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
