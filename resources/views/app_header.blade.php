<header class="header">
    <div class="container">
        <a class="header__brand" href="{{ url('/') }}">
            {{--{{ config('app.name', 't-kalach') }}--}}
            T-kalach.ru
        </a>


    <!--<nav class="main-menu d-none d-md-inline-block">
            <ul class="main-menu__list">
                <li class="main-menu__item {{ is_active('news.*') }}">
                    <a href="" class="main-menu__link">Новости</a>
                    <ul class="main-menu-dropdown">
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                    </ul>
                </li>
                <li class="main-menu__item {{ is_active('users.*') }}">
                    <a href="" class="main-menu__link">Пользователи</a>
                    <ul class="main-menu-dropdown">
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                        <li class="main-menu-dropdown__item"><a href="#" class="main-menu-dropdown__link">Dropdown link</a></li>
                    </ul>
                </li>
            </ul>
        </nav>-->

        @guest
            <div class="auth-menu">
                <ul class="auth-menu__list">
                    <li class="auth-menu__item">
                        <a href="{{ route('login') }}" class="ajax auth-menu__link"
                           data-toggle="modal"
                           data-url="{{ route('login') }}" data-name="Войти"
                           data-modal-size="modal-sm">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
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