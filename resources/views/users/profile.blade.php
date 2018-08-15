@extends('app_sidebar')

@section('content')

    <h1 class="h5">Профиль</h1>
    <hr>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(Auth::id() == $user->id)
            <div class="d-block">
                <a href="{{ route('users.profile.settings', $user->id) }}" class="text-muted">Настройки</a>
            </div>
            @endif
        <div>
            <strong style="display:block"><strong>@</strong>{{ $user->nickname }}</strong>
            <span>{{ $user->profile->first_name }} </span>
            <span>{{ $user->profile->last_name }}</span>
            <span style="display:block">{{ $user->profile->birthday }}</span>
            <span style="display:block">{{ $user->profile->location }}</span>
        </div>
            <div>
                <img src="{{ getAvatar('big', $user->profile->avatar) }}" alt="" width="200px">
            </div>
        <div>
            {!! $user->profile->about !!}
        </div>

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
            <li><a href="{{ route('login') }}" class="" data-toggle="modal"
                   data-url="{{ route('login') }}" data-name="Войти" data-modal-size="modal-sm">Войти</a></li>
            <li><a href="{{ route('register') }}">Регистрация</a></li>
        @else
                {{--<a href="{{ route('users.profile', Auth::id()) }}">--}}
                {{--{{ Auth::user()->nickname }}--}}
                {{--</a>--}}


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
