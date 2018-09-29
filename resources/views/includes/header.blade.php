<header class="page-header">
    <nav class="page-header__nav container">
        <div class="page-header__logo">
            <a href="{{ route('home') }}">
                <img src="{{asset('images/blue-logo.png')}}" alt="mawdoo3 logo">
            </a>
            <span>أكبر موقع عربي بالعالم</span>
        </div>

        <div class="page-header__nav-items">
            <a href="{{ route('home') }}" class="page-header__nav-item">التصنيفات</a>
            <a href="{{ route('posts.index', ['latest' => 1]) }}" class="page-header__nav-item">تصفح المواضيع</a>
            @auth
                <a href="{{ route('posts.create') }}" class="page-header__nav-item">أكتب موضوع</a>
                <a href="javascript:" onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="page-header__nav-item no-barba">تسجيل الخروج</a>
                <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="POST">@csrf</form>
            @else 
                <a href="{{ route('register') }}" class="page-header__nav-item">تسجيل</a>
                <a href="{{ route('login') }}" class="page-header__nav-item">دخول</a>
            @endauth
        </div>
    </nav>
</header>