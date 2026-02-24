@include('layout.sidebar')


  <main class="main-content">

        <!-- Header -->
        <header class="page-header">
            <div class="header-content">
                <h1><i class="fas fa-user"></i> الملف الشخصي</h1>
                <p>إدارة معلوماتك الشخصية وإعدادات حسابك</p>
            </div>
            <button class="btn-primary">
                <i class="fas fa-edit"></i>
                تعديل الملف الشخصي
            </button>
        </header>

        <!-- ============================================ -->
        <!-- Profile Cover - غلاف البروفايل -->
        <!-- ============================================ -->
        <section class="profile-cover">
            <div class="cover-image">
                <!-- يمكن إضافة صورة خلفية هنا -->
            </div>
            <div class="profile-header-content">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar">
                        <img src="https://ui-avatars.com/api/?name=Ahmed+Mohamed&background=522B5B&color=FBE4D8&size=200&bold=true&font-size=0.4" alt="Profile Picture">
                        <button class="change-avatar-btn">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <div class="profile-badge verified">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="profile-info">
                    <h2>أحمد محمد حسن</h2>
                    <p class="profile-role">
                        <i class="fas fa-briefcase"></i>
                        مدير النظام
                    </p>
                    <p class="profile-email">
                        <i class="fas fa-envelope"></i>
                        ahmed.mohamed@debtmate.com
                    </p>
                    <p class="profile-join-date">
                        <i class="fas fa-calendar"></i>
                        انضم في يناير 2025
                    </p>
                </div>
                <div class="profile-actions">
                    <button class="btn-secondary">
                        <i class="fas fa-download"></i>
                        تحميل السيرة المالية
                    </button>
                    <button class="btn-secondary">
                        <i class="fas fa-share-alt"></i>
                        مشاركة
                    </button>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- Profile Stats - إحصائيات المستخدم -->
        <!-- ============================================ -->
        <section class="profile-stats">
            <div class="stat-box">
                <div class="stat-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-details">
                    <h3>15</h3>
                    <p>إجمالي الديون</p>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-details">
                    <h3>8</h3>
                    <p>ديون مسددة</p>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-details">
                    <h3>7</h3>
                    <p>ديون نشطة</p>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-details">
                    <h3>98%</h3>
                    <p>نسبة الالتزام</p>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- Profile Content - محتوى البروفايل -->
        <!-- ============================================ -->
        <div class="profile-content-grid">

            <!-- ============================================ -->
            <!-- Left Column - العمود الأيسر -->
            <!-- ============================================ -->
            <div class="profile-left-column">

                <!-- Personal Information -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-info-circle"></i> المعلومات الشخصية</h3>
                        <button class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user"></i>
                                الاسم الكامل
                            </span>
                            <span class="info-value">أحمد محمد حسن</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-phone"></i>
                                رقم الهاتف
                            </span>
                            <span class="info-value">+20 123 456 7890</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-envelope"></i>
                                البريد الإلكتروني
                            </span>
                            <span class="info-value">ahmed.mohamed@debtmate.com</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                العنوان
                            </span>
                            <span class="info-value">القاهرة، مصر</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-birthday-cake"></i>
                                تاريخ الميلاد
                            </span>
                            <span class="info-value">15 يناير 1995</span>
                        </div>
                    </div>
                </div>

                <!-- Account Security -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-shield-alt"></i> أمان الحساب</h3>
                    </div>
                    <div class="security-list">
                        <div class="security-item">
                            <div class="security-info">
                                <i class="fas fa-key"></i>
                                <div>
                                    <h4>كلمة المرور</h4>
                                    <p>آخر تحديث: منذ 30 يوم</p>
                                </div>
                            </div>
                            <button class="btn-change">تغيير</button>
                        </div>
                        <div class="security-item">
                            <div class="security-info">
                                <i class="fas fa-mobile-alt"></i>
                                <div>
                                    <h4>التحقق بخطوتين</h4>
                                    <p class="status-enabled">مفعّل</p>
                                </div>
                            </div>
                            <button class="btn-change">إعدادات</button>
                        </div>
                        <div class="security-item">
                            <div class="security-info">
                                <i class="fas fa-history"></i>
                                <div>
                                    <h4>سجل الدخول</h4>
                                    <p>آخر دخول: اليوم 10:30 ص</p>
                                </div>
                            </div>
                            <button class="btn-change">عرض</button>
                        </div>
                    </div>
                </div>

                <!-- Connected Accounts -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-link"></i> الحسابات المرتبطة</h3>
                    </div>
                    <div class="connected-accounts">
                        <div class="account-item connected">
                            <div class="account-icon google">
                                <i class="fab fa-google"></i>
                            </div>
                            <div class="account-info">
                                <h4>Google</h4>
                                <p>مرتبط</p>
                            </div>
                            <button class="btn-disconnect">فصل</button>
                        </div>
                        <div class="account-item not-connected">
                            <div class="account-icon facebook">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="account-info">
                                <h4>Facebook</h4>
                                <p>غير مرتبط</p>
                            </div>
                            <button class="btn-connect">ربط</button>
                        </div>
                        <div class="account-item not-connected">
                            <div class="account-icon twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="account-info">
                                <h4>Twitter</h4>
                                <p>غير مرتبط</p>
                            </div>
                            <button class="btn-connect">ربط</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ============================================ -->
            <!-- Right Column - العمود الأيمن -->
            <!-- ============================================ -->
            <div class="profile-right-column">

                <!-- Activity Timeline -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-clock"></i> آخر الأنشطة</h3>
                        <a href="#" class="link-more">عرض الكل</a>
                    </div>
                    <div class="activity-timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot payment"></div>
                            <div class="timeline-content">
                                <h4>سداد قسط البنك</h4>
                                <p>تم سداد مبلغ 2,000 ج.م</p>
                                <span class="timeline-time">منذ ساعتين</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot new"></div>
                            <div class="timeline-content">
                                <h4>إضافة دين جديد</h4>
                                <p>فاتورة الكهرباء - 500 ج.م</p>
                                <span class="timeline-time">أمس</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot payment"></div>
                            <div class="timeline-content">
                                <h4>سداد فاتورة الإنترنت</h4>
                                <p>تم سداد مبلغ 340 ج.م</p>
                                <span class="timeline-time">منذ يومين</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot update"></div>
                            <div class="timeline-content">
                                <h4>تحديث الملف الشخصي</h4>
                                <p>تم تحديث رقم الهاتف</p>
                                <span class="timeline-time">منذ 3 أيام</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot payment"></div>
                            <div class="timeline-content">
                                <h4>سداد قسط السيارة</h4>
                                <p>تم سداد مبلغ 3,500 ج.م</p>
                                <span class="timeline-time">منذ 4 أيام</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Achievements -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-trophy"></i> الإنجازات</h3>
                    </div>
                    <div class="achievements-grid">
                        <div class="achievement-badge unlocked">
                            <div class="badge-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h4>الدفعة الأولى</h4>
                            <p>قمت بأول عملية سداد</p>
                        </div>
                        <div class="achievement-badge unlocked">
                            <div class="badge-icon">
                                <i class="fas fa-fire"></i>
                            </div>
                            <h4>متواصل</h4>
                            <p>5 دفعات متتالية في الموعد</p>
                        </div>
                        <div class="achievement-badge unlocked">
                            <div class="badge-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4>ملتزم</h4>
                            <p>نسبة التزام 95%+</p>
                        </div>
                        <div class="achievement-badge locked">
                            <div class="badge-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h4>خالٍ من الديون</h4>
                            <p>سداد جميع الديون</p>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="info-card">
                    <div class="card-header">
                        <h3><i class="fas fa-wallet"></i> الملخص المالي</h3>
                    </div>
                    <div class="financial-summary">
                        <div class="summary-item">
                            <span class="summary-label">إجمالي المدفوع حتى الآن</span>
                            <span class="summary-value positive">45,680 ج.م</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">متوسط الدفعة الشهرية</span>
                            <span class="summary-value">3,807 ج.م</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">أكبر دفعة</span>
                            <span class="summary-value">8,500 ج.م</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">أصغر دفعة</span>
                            <span class="summary-value">200 ج.م</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-item">
                            <span class="summary-label">الوفورات المحققة</span>
                            <span class="summary-value success">2,340 ج.م</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>




    @include('layout.footer')
