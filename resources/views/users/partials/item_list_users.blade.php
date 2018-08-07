<div class="users-list__item">
    <div class="users-list__image" onclick="location.href='{{ route('users.profile', $user->id) }}'">
        <img src="{{ getAvatar('micro', $user->profile->avatar) }}" alt="{{ $user->nickname }}">
        @if( $user->isOnline() )
            <span class="component-status component-status--online"></span>
        @else
            <span class="component-status component-status--offline"></span>
        @endif
    </div>
    <a href="{{ route('users.profile', $user->id) }}" title="Профиль пользователя {{ $user->nickname }}"
       class="user-list__link d-block">
        <strong>{{ $user->nickname }}</strong>
    </a>
    <div>
        @if( $user->profile->first_name )
            {{ $user->profile->first_name }}
        @endif

        @if( $user->profile->last_name )
            {{ $user->profile->last_name }}
        @endif
    </div>
    <strong></strong>
    @if($user->isOnline())
        <span class="d-block text-muted small lh-125 font-weight-light font-monospace">
            онлайн
        </span>
    @else
        <span class="d-block text-muted small lh-125 font-weight-light font-monospace">
            {{ getOnlineTime($user->profile->gender, $user->profile->offline_at->diffForHumans()) }}
        </span>
    @endif
</div>