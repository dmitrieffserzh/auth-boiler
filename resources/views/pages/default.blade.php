@extends('app_sidebar')
{{-- META --}}

@section('content')

    <section class="section">
        <h1 class="h5">{{ $page->title }}</h1>

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="col">
            <div class="row">
            {!! $page->content !!}
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
            <li><a href="{{ route('login') }}" >Войти</a></li>
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
