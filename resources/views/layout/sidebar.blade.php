<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Mate - Dashboard</title>

    <!-- ربط ملفات CSS -->
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/debts.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/profile.css">
    {{-- <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/notifications.css"> --}}
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/payments.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/reports.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/settings.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/dashboard.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/css/components.css">

    <!-- Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <!-- Chart.js للرسوم البيانية -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- ============================================ -->
    <!-- Sidebar - القائمة الجانبية -->
    <!-- ============================================ -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-coins"></i>
            <h2>Debt Mate</h2>
        </div>

        <nav class="nav-menu">
            <a href="{{route('dashboard')}}" class="nav-item ">
                <i class="fas fa-home"></i>
                <span>الرئيسية</span>
            </a>
            <a href="{{route('debts')}}" class="nav-item">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>الديون</span>
            </a>
            <a href="{{route('payments')}}" class="nav-item">
                <i class="fas fa-money-bill-wave"></i>
                <span>السداد</span>
            </a>

        </nav>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
    @csrf
    <button type="submit" class="nav-item" style="width:100%; border:none; background:none; cursor:pointer; color:inherit;">
        <i class="fas fa-sign-out-alt"></i>
        <span>تسجيل الخروج</span>
    </button>
</form>
<a href="{{ route('profile') }}" class="user-profile">
    <div class="user-avatar">
        <i class="fas fa-user-circle"></i>
    </div>
    <div class="user-info">
        <h4>{{ auth()->user()->name }}</h4>
        <p>{{ auth()->user()->role == 'creditor' ? 'دائن' : 'مدين' }}</p>
    </div>
</a>
    </aside>
