<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الفتيح لبيع الدرجات النارية</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Small inline fixes or dynamic values if needed */
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-right">
                <div class="logo">الفتيح</div>
            </div>
            <div class="menu-toggle" id="mobile-menu">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </div>
            <div class="header-center">
                <nav>
                    <a href="{{ route('home') }}">الرئيسية</a>
                    <a href="{{ route('home') }}#products">المتوفر لدينا</a>
                    <a href="{{ route('home') }}#location">موقعنا</a>
                    <a href="{{ route('home') }}#contact">تواصل معنا</a>
                </nav>
            </div>
            <div class="header-left">
                @guest
                    <a href="{{ route('login') }}" class="btn login-btn">انضم إلينا</a>
                @else
                    <div class="user-menu" style="display: flex; align-items: center; gap: 15px;">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%; border: 1px solid var(--primary-color);">
                        @endif
                        <span style="color: #fff;">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-link" style="background: none; border: none; color: var(--primary-color); cursor: pointer; font-size: 0.9rem;">خروج</button>
                        </form>
                    </div>
                @endguest
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} معرض الفتيح للدرجات النارية. جميع الحقوق محفوظة.</p>
        </footer>
    </div>

    <script>
        const menuToggle = document.getElementById('mobile-menu');
        const headerCenter = document.querySelector('.header-center');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                headerCenter.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
