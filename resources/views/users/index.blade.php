@extends('app_sidebar')

@section('content')

    <h1 class="h5">Пользователи</h1>
    <hr>
    <div class="users-list">
        @forelse ($users as $user)
            @include('users.partials.item_list_users')
        @empty
            <div class="alert alert-primary" role="alert">
                Нет пользователей!
            </div>
        @endforelse
<br>
            {{ $users->links() }}
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
            <li><a href="{{ route('login') }}">Войти</a></li>
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