<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Mate - تسجيل الدخول</title>

    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">
        <div class="logo">
            <i class="fas fa-coins"></i>
            <h1>Debt Mate</h1>
            <p>إدارة ذكية للديون والمدفوعات</p>
        </div>

        <div class="error-message" id="errorMessage">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorText">البريد الإلكتروني أو كلمة المرور غير صحيحة</span>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@debtmate.com"
                        required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                        required>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>تذكرني</span>
                </label>
                <a href="#" class="forgot-password">نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                تسجيل الدخول
            </button>
        </form>

        <div class="divider">
            <span>أو</span>
        </div>

        <div class="signup-link">
            ليس لديك حساب؟ <a href="register.html">إنشاء حساب جديد</a>
        </div>
    </div>

    <script src="{{asset('dashboard')}}/assets/js/login.js"></script>

</body>

</html>
