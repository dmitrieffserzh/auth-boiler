@extends('app')

@section('content')

    <h1 class="h5">Главная страница</h1>
    <hr>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @guest

                            Авторизуйтесь
                        @else
                             {{ Auth::user()->name }}
                        @endguest

                    @if(isset($service))
                        @if($service == 'vkontakte')
                            <div class="title m-b-md">
                                Привет, <b>{{ $details->name}}</b>! <br>
                                <br> <img src="{{ $details->avatar }}" width="300px">
                            </div>
                        @endif


                        @if($service == 'facebook')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name']}} ! <br> Your email is : {{
                                $details->user['email'] }} <br> <img src="{{ $details->avatar_original }}" width="300px">
                            </div>
                        @endif

                        @if($service == 'instagram')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['username']}} ! <br>
                                <img src="{{ $details->user['profile_picture'] }}">

                            </div>
                        @endif
                    @endif
                </div>

@endsection

@section('aside')
    <h6 class="text-uppercase border-bottom border-gray pb-2 text-primary">Боковая колонка</h6>
    <ul class="aside-menu">
        <li><a href="{{ route('users.index') }}">Пользователи</a></li>
        <li><a href="{{ route('news.index') }}">Новости</a></li>

    @if(Auth::check())
        {{--@if( Auth::user()->role == 'editor' || Auth::user()->is_admin())--}}
        {{--<li><a href="{{ route('admin.dashboard') }}">Панель управления</a></li>--}}
        {{--@endif--}}
    @endif
    <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ route('login') }}" class="ajax-modal main-menu__link" data-toggle="modal"
                   data-url="{{ route('login') }}" data-name="Войти" data-modal-size="modal-sm">Войти</a></li>
            <li><a href="{{ route('register') }}">Регистрация</a></li>
        @else
            <li>
                {{--<a href="{{ route('users.profile', Auth::id()) }}">--}}
                {{--{{ Auth::user()->nickname }}--}}
                {{--</a>--}}

            </li>

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    Выйти
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        @endif
    </ul>
@endsection