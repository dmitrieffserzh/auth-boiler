<header class="header">
    <div class="container">
        <a class="header__brand" href="{{ url('/') }}">
            {{--{{ config('app.name', 't-kalach') }}--}}
            LINKTOME
        </a>


    <nav class="main-menu">
            <ul class="main-menu__list">
                <li class="main-menu__item {{ is_active('news.*') }}">
                    <a href="{{ route('news.index') }}" class="main-menu__link">Новости</a>
                    <ul class="main-menu-dropdown">
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                    </ul>
                </li>
                <li class="main-menu__item d-none d-md-inline-block {{ is_active('users.*') }}">
                    <a href="{{ route('users.index') }}" class="main-menu__link">Пользователи</a>
                </li>
                <li class="main-menu__item {{ is_active('page') }}">
                    <a href="{{ route('page', 'contacts') }}" class="main-menu__link">Контакты</a>
                    <ul class="main-menu-dropdown">
                        <li class="main-menu-dropdown__item"><a href="{{ route('page', 'about-us') }}" class="main-menu-dropdown__link">О нас</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                    </ul>
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
                            <span class="d-none d-md-block float-left">
                                {{ __('Войти') }}
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        @else
            <div class="auth-menu">
                <ul class="auth-menu__list">
                    <li class="auth-menu__item">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="auth-menu__link">


                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-user">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span class="d-none d-md-block float-left">
                            {{ __('Выйти') }}
                            </span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </div>
        {{--@include('widgets.users.user_menu_top')--}}

    @endguest


    <!--<div class="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" class="search__form rounded">
        </div>-->

    <!--
        <nav class="main-menu">
            <ul class="main-menu__list">
                <li class="main-menu__item {{ is_active('news.*') }}">
                    <a href="" class="main-menu__link">Новости</a>
                </li>
                <li class="main-menu__item">
                    <a href="#" class="main-menu__link">События</a>
                </li>
                <li class="main-menu__item">
                    <a href="#" class="main-menu__link">Ссылка</a>
                </li>
                <li class="main-menu__item">
                    <a href="#" class="main-menu__link">Ссылка</a>
                </li>
                <li class="main-menu__item {{ is_active('users.*') }}">
                    <a href="#" class="main-menu__link">Пользователи</a>
                </li>
            </ul>
        </nav>
-->
    </div>
</header>