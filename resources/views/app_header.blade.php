<header class="header">
    <div class="container">

        <button type="button" id="button-menu" class="button-menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        @if(request()->route()->getName() == 'home')
            <div class="header__brand" onclick="location.reload();">
                <span class="header__brand-first">Women</span>
                <span class="header__brand-last">SAY!</span>
            </div>
        @else
            <a class="header__brand" href="{{ url('/') }}">
                <span class="header__brand-first">Women</span>
                <span class="header__brand-last">SAY!</span>
            </a>
        @endif

    <nav id="menu-block" class="main-menu">
            <ul class="main-menu__list">
                <li class="main-menu__item {{ is_active('news.*') }}">
                    <a href="{{ route('news.index') }}" class="main-menu__link">Новости</a>
                    <ul class="main-menu-dropdown">
                        <li class="main-menu-dropdown__item"><a href="{{ route('news.category', 'beauty_health') }}" class="main-menu-dropdown__link">Красота и здоровье</a></li>
                        <li class="main-menu-dropdown__item"><a href="{{ route('news.category', 'fashion_style') }}" class="main-menu-dropdown__link">Мода и стиль</a></li>
                    </ul>
                </li>
                <li class="main-menu__item {{ is_active('users.*') }}">
                    <a href="{{ route('users.index') }}" class="main-menu__link">Пользователи</a>
                </li>
                <li class="main-menu__item {{ is_active('page') }}">
                    <a href="{{ route('page', 'contacts') }}" class="main-menu__link">Контакты</a>
                </li>
            </ul>
        </nav>

        @guest
            <div class="auth-menu">
                <ul class="auth-menu__list">
                    <li class="auth-menu__item">
                        <a href="{{ route('login') }}" class="ajax auth-menu__link"
                           data-toggle="modal"
                           data-url="{{ route('login') }}" data-name="Войти"
                           data-modal-size="modal-sm">

                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="d-none d-md-inline-block">
                                {{ __('Войти') }}
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        @else
            @include('components.user_menu.user_menu_top')
        @endguest


    <!--<div class="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" class="search__form rounded">
        </div>-->

    </div>
    <div class="modal-bg"></div>
</header>