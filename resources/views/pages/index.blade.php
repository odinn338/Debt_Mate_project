@include('layout.sidebar')



   <main class="main-content">

        <!-- Header -->
        <header class="dashboard-header">
            <div class="welcome-section">
                <h1>مرحباً بك، أحمد! 👋</h1>
                <p>إليك نظرة سريعة على حالتك المالية اليوم</p>
            </div>

            <div class="header-actions">
                <button class="btn-notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <button class="btn-primary">
                    <i class="fas fa-plus"></i>
                    إضافة دين جديد
                </button>
            </div>
        </header>

        <!-- ============================================ -->
        <!-- Statistics Cards - بطاقات الإحصائيات -->
        <!-- ============================================ -->
        <section class="statistics-section">
            <div class="stat-card total-debt">
                <div class="stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-content">
                    <h3>إجمالي الديون</h3>
                    <p class="stat-number">26,000 ج.م</p>
                    <span class="stat-label">جميع الديون المسجلة</span>
                </div>
                <div class="stat-trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>12%</span>
                </div>
            </div>

            <div class="stat-card paid">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>المبالغ المسددة</h3>
                    <p class="stat-number">12,340 ج.م</p>
                    <span class="stat-label">تم سدادها بنجاح</span>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-check"></i>
                    <span>47%</span>
                </div>
            </div>

            <div class="stat-card remaining">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-content">
                    <h3>المتبقي للسداد</h3>
                    <p class="stat-number">13,660 ج.م</p>
                    <span class="stat-label">يجب سداده</span>
                </div>
                <div class="stat-trend down">
                    <i class="fas fa-arrow-down"></i>
                    <span>53%</span>
                </div>
            </div>

            <div class="stat-card overdue">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>ديون متأخرة</h3>
                    <p class="stat-number">2,500 ج.م</p>
                    <span class="stat-label">تحتاج انتباه فوري</span>
                </div>
                <div class="stat-trend alert">
                    <i class="fas fa-clock"></i>
                    <span>عاجل</span>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- Charts Section - الرسوم البيانية -->
        <!-- ============================================ -->
        <section class="charts-section">

            <!-- Chart 1: دائرة التقدم -->
            <div class="chart-card progress-chart">
                <div class="card-header">
                    <h3>نسبة السداد</h3>
                    <button class="btn-more">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div class="chart-container">
                    <canvas id="progressChart"></canvas>
                    <div class="chart-center-text">
                        <h2>47%</h2>
                        <p>مكتمل</p>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color paid"></span>
                        <span>مسدد (12,340 ج.م)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color remaining"></span>
                        <span>متبقي (13,660 ج.م)</span>
                    </div>
                </div>
            </div>

            <!-- Chart 2: الديون حسب الشهر -->
            <div class="chart-card line-chart">
                <div class="card-header">
                    <h3>تحليل السداد الشهري</h3>
                    <div class="time-filter">
                        <button class="active">شهر</button>
                        <button>3 أشهر</button>
                        <button>سنة</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

        </section>

        <!-- ============================================ -->
        <!-- Recent Transactions & Notifications -->
        <!-- ============================================ -->
        <section class="info-section">

            <!-- آخر المعاملات -->
            <div class="info-card transactions">
                <div class="card-header">
                    <h3>آخر المعاملات</h3>
                    <a href="#" class="link-more">عرض الكل <i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="transactions-list">

                    <div class="transaction-item">
                        <div class="transaction-icon paid">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>سداد قسط البنك</h4>
                            <p>منذ ساعتين</p>
                        </div>
                        <div class="transaction-amount paid">
                            - 2,000 ج.م
                        </div>
                    </div>

                    <div class="transaction-item">
                        <div class="transaction-icon new">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>دين جديد - فاتورة كهرباء</h4>
                            <p>أمس</p>
                        </div>
                        <div class="transaction-amount new">
                            + 500 ج.م
                        </div>
                    </div>

                    <div class="transaction-item">
                        <div class="transaction-icon paid">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>سداد فاتورة الإنترنت</h4>
                            <p>منذ يومين</p>
                        </div>
                        <div class="transaction-amount paid">
                            - 340 ج.م
                        </div>
                    </div>

                    <div class="transaction-item">
                        <div class="transaction-icon paid">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>سداد قسط السيارة</h4>
                            <p>منذ 3 أيام</p>
                        </div>
                        <div class="transaction-amount paid">
                            - 3,500 ج.م
                        </div>
                    </div>

                    <div class="transaction-item">
                        <div class="transaction-icon new">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>دين جديد - مصاريف طبية</h4>
                            <p>منذ أسبوع</p>
                        </div>
                        <div class="transaction-amount new">
                            + 1,200 ج.م
                        </div>
                    </div>

                </div>
            </div>

            <!-- التنبيهات المهمة -->
            <div class="info-card notifications">
                <div class="card-header">
                    <h3>تنبيهات مهمة</h3>
                    <span class="badge-count">3</span>
                </div>
                <div class="notifications-list">

                    <div class="notification-item urgent">
                        <div class="notification-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="notification-content">
                            <h4>دين متأخر!</h4>
                            <p>فاتورة الكهرباء متأخرة 5 أيام</p>
                            <span class="time">الآن</span>
                        </div>
                    </div>

                    <div class="notification-item warning">
                        <div class="notification-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="notification-content">
                            <h4>اقتراب موعد السداد</h4>
                            <p>قسط البنك مستحق خلال 3 أيام</p>
                            <span class="time">منذ ساعة</span>
                        </div>
                    </div>

                    <div class="notification-item info">
                        <div class="notification-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="notification-content">
                            <h4>تذكير</h4>
                            <p>فاتورة الإنترنت مستحقة الأسبوع القادم</p>
                            <span class="time">أمس</span>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- ============================================ -->
        <!-- Upcoming Payments - الدفعات القادمة -->
        <!-- ============================================ -->
        <section class="upcoming-section">
            <div class="section-header">
                <h2>الدفعات القادمة</h2>
                <div class="filter-tabs">
                    <button class="active">الكل</button>
                    <button>هذا الأسبوع</button>
                    <button>هذا الشهر</button>
                </div>
            </div>

            <div class="upcoming-grid">

                <div class="payment-card priority-high">
                    <div class="payment-header">
                        <div class="payment-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <span class="priority-badge high">عالية</span>
                    </div>
                    <h3>قسط البنك الشهري</h3>
                    <p class="payment-amount">2,000 ج.م</p>
                    <div class="payment-date">
                        <i class="fas fa-calendar"></i>
                        <span>مستحق في 15 فبراير 2026</span>
                    </div>
                    <div class="payment-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 60%;"></div>
                        </div>
                        <span>3 أيام متبقية</span>
                    </div>
                    <button class="btn-pay">سداد الآن</button>
                </div>

                <div class="payment-card priority-medium">
                    <div class="payment-header">
                        <div class="payment-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <span class="priority-badge medium">متوسطة</span>
                    </div>
                    <h3>فاتورة الكهرباء</h3>
                    <p class="payment-amount">450 ج.م</p>
                    <div class="payment-date">
                        <i class="fas fa-calendar"></i>
                        <span>مستحق في 20 فبراير 2026</span>
                    </div>
                    <div class="payment-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 40%;"></div>
                        </div>
                        <span>8 أيام متبقية</span>
                    </div>
                    <button class="btn-pay">سداد الآن</button>
                </div>

                <div class="payment-card priority-low">
                    <div class="payment-header">
                        <div class="payment-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <span class="priority-badge low">منخفضة</span>
                    </div>
                    <h3>اشتراك الإنترنت</h3>
                    <p class="payment-amount">340 ج.م</p>
                    <div class="payment-date">
                        <i class="fas fa-calendar"></i>
                        <span>مستحق في 28 فبراير 2026</span>
                    </div>
                    <div class="payment-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 20%;"></div>
                        </div>
                        <span>16 يوم متبقي</span>
                    </div>
                    <button class="btn-pay">سداد الآن</button>
                </div>

            </div>
        </section>

    </main>








@include('layout.footer')
