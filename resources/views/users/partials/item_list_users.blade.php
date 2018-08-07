<div class="users-list__item">
    <div class="users-list__image">
        <img src="{{ getAvatar('micro', $user->profile->avatar) }}" alt="">
    </div>
    <a href="{{ route('users.profile', $user->id) }}" class="user-list__link">
        {{ $user->profile->first_name }}
        {{ $user->profile->last_name }}
    </a>
    <strong><span>@</span>{{ $user->nickname }}</strong>
</div>