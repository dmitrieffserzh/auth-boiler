<div class="user_wgt d-inline-block" style="float: right; line-height: 3.3rem;">
    <a class="d-inline-block" href="{{ route('users.profile', Auth::id()) }}" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
        <img class="rounded-circle"
             style="width: 40px; height: 40px; border-radius: 50%; border: 2px Solid rgba(255, 255, 255, 0.1);"
             src="{{ getAvatar('micro', Auth::user()->profile->avatar) }}"
             alt="{{ Auth::user()->nickname }}">
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown" style="line-height: initial;">
        <div class="dropdown-header"><strong style="display:block"><strong>@</strong>{{ Auth::user()->nickname }}</strong></div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('users.profile', Auth::id()) }}">{{ __('Мой профиль') }}</a>
        <a class="dropdown-item" href="{{ route('users.profile', Auth::id()) }}">{{ __('Мои подписчики') }}</a>
        <a class="dropdown-item" href="{{ route('users.profile', Auth::id()) }}">{{ __('Мои подписки') }}</a>
        <a class="dropdown-item" href="{{ route('users.profile', Auth::id()) }}">{{ __('Мои сообщения') }}</a>
        <a class="dropdown-item" href="{{ route('users.profile', Auth::id()) }}">{{ __('Мои публикации') }}</a>

        {{--@if(Auth::user()->is_admin())--}}
            {{--<a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Панель управления') }}</a>--}}
        {{--@endif--}}

        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>