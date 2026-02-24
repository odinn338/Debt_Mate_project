<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Mate - إنشاء حساب جديد</title>

    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="register-container">
        <div class="logo">
            <i class="fas fa-coins"></i>
            <h1>إنشاء حساب جديد</h1>
            <p>انضم إلى Debt Mate اليوم</p>
        </div>

        <div class="success-message" id="successMessage">
            <i class="fas fa-check-circle"></i>
            <span>تم إنشاء الحساب بنجاح! جاري تحويلك...</span>
        </div>

        <div class="error-message" id="errorMessage">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorText">حدث خطأ. حاول مرة أخرى</span>
        </div>

        <form id="registerForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">الاسم الأول</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="firstName" name="firstName" class="form-control"
                               placeholder="">
                    </div>
                </div>


            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="example@debtmate.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" id="phone" name="phone" class="form-control"
                           placeholder="+20 123 456 7890" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="••••••••" required minlength="8">
                    </div>
                </div>


            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i>
                إنشاء الحساب
            </button>
        </form>

        <div class="divider">
            <span>أو</span>
        </div>

        <div class="login-link">
            لديك حساب بالفعل؟ <a href="{{route('login')}}">تسجيل الدخول</a>
        </div>
    </div>

    <script src="{{asset('dashboard')}}/assets/js/register.js"></script>

</body>
</html>
