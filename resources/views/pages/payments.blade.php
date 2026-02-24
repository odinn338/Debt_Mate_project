@include('layout.sidebar')


    <main class="main-content">

        <header class="page-header">
            <div class="header-content">
                <h1><i class="fas fa-money-bill-wave"></i> عمليات السداد</h1>
                <p>تسجيل ومتابعة جميع عمليات السداد والدفعات</p>
            </div>
            <button class="btn-primary" id="addPaymentBtn">
                <i class="fas fa-plus"></i>
                تسجيل دفعة جديدة
            </button>
        </header>

        <!-- Payment Stats -->
        <section class="payment-stats">
            <div class="payment-stat-card">
                <div class="stat-icon"><i class="fas fa-wallet"></i></div>
                <div class="stat-info">
                    <h3>إجمالي المدفوع</h3>
                    <p class="stat-number">45,680 ج.م</p>
                </div>
            </div>
            <div class="payment-stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-month"></i></div>
                <div class="stat-info">
                    <h3>هذا الشهر</h3>
                    <p class="stat-number">8,340 ج.م</p>
                </div>
            </div>
            <div class="payment-stat-card">
                <div class="stat-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="stat-info">
                    <h3>متوسط الدفعة</h3>
                    <p class="stat-number">2,085 ج.م</p>
                </div>
            </div>
        </section>

        <!-- Payment History Table -->
        <section class="payments-table-section">
            <h2>سجل المدفوعات</h2>
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>الدين</th>
                        <th>المبلغ</th>
                        <th>طريقة الدفع</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody id="paymentsBody">
                    <tr>
                        <td>اليوم - 10:30 ص</td>
                        <td>قسط البنك</td>
                        <td>2,000 ج.م</td>
                        <td>بطاقة</td>
                        <td><span class="badge-success">مكتمل</span></td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <!-- Add Payment Modal -->
    <div class="modal" id="addPaymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>تسجيل دفعة جديدة</h2>
                <button class="modal-close" id="closeModal">×</button>
            </div>
            <form id="paymentForm">
                <div class="form-group">
                    <label>اختر الدين</label>
                    <select name="debt" required>
                        <option>قسط البنك</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ</label>
                    <input type="number" name="amount" required>
                </div>
                <button type="submit" class="btn-submit">تأكيد</button>
            </form>
        </div>
    </div>





@include('layout.footer')
