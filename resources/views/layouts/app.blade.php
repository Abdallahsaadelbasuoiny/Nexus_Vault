<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'الرئيسية') -
        @auth
        @if(in_array(auth()->user()->role, ['admin', 'adminRole']))
        لوحة الإدارة
        @else
        معرض المنتجات
        @endif
        @else
        معرض المنتجات
        @endauth
    </title>

    <!-- Google Fonts (Cairo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">

            <!-- عنوان الهيدر -->
            @auth
            @if(in_array(auth()->user()->role, ['admin', 'adminRole']))
            <a class="navbar-brand fw-bold" href="{{ route('admin.products.index') }}">لوحة الإدارة</a>
            @else
            <a class="navbar-brand fw-bold" href="{{ route('user.products') }}">معرض المنتجات</a>
            @endif
            @else
            <a class="navbar-brand fw-bold" href="{{ route('user.products') }}">معرض المنتجات</a>
            @endauth

            <div class="d-flex align-items-center gap-3">
                @auth
                {{-- للأدمن فقط --}}
                @if(in_array(auth()->user()->role, ['admin', 'adminRole']))
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-speedometer2 me-1"></i> لوحة التحكم
                </a>
                @endif

                <span class="text-white small">
                    مرحباً بك، {{ auth()->user()->name }}
                </span>

                <!-- نموذج زر تسجيل الخروج -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        تسجيل الخروج
                    </button>
                </form>
                @else
                {{-- للزائر غير المسجل --}}
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i> تسجيل الدخول
                </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- محتوى الصفحة الرئيسي -->
    <main>
        <div class="container mb-3">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- مكتبات Echo و Pusher للتحديث اللحظي -->
    <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });

        // الاستماع لقناة التحديثات
        window.Echo.channel('products')
            .listen('.product.updated', (data) => {
                console.log('تم تعديل المنتج:', data.product);
                location.reload(); // إعادة تحميل الصفحة لتحديث البيانات
            });
    </script>
</body>

</html>