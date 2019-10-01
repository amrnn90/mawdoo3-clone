<header class="page-header {{ Route::currentRouteName() == 'home' ? '' : 'page-header--compact page-header--with-search' }}">
    <nav class="page-header__nav container">
        <div class="page-header__meta">
            <div class="page-header__logo ">
                <a href="{{ route('home') }}" class="page-header__logoimg"></a>
            </div>
            <span>أكبر موقع عربي بالعالم</span>
        </div>

        <div class="page-header__search-form">
            @include('includes.search-form')
        </div>

        <button class="page-header__toggle page-header__toggle--nocompact hamburger hamburger--spring" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
        </button>
        <button class="page-header__toggle page-header__toggle--compact hamburger hamburger--spring" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
        </button>
        <div class="page-header__nav-items">
            <div class="page-header__nav-items-inner">
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
        </div>
    </nav>
</header>