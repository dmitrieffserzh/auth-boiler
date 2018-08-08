@extends('app_sidebar')

@section('content')

    <div class="card-header">Profile</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="d-block">
            <a href="{{ route('users.profile.settings', $user->id) }}" class="text-muted">Настройки</a>
        </div>
        <div>
            <strong style="display:block"><strong>@</strong>{{ $user->nickname }}</strong>
            <span>{{ $user->profile->first_name }} </span>
            <span>{{ $user->profile->last_name }}</span>
            <span style="display:block">{{ $user->profile->birthday }}</span>
            <span style="display:block">{{ $user->profile->location }}</span>
        </div>
            <div>
                <img src="{{ getAvatar('big', $user->profile->avatar) }}" alt="" width="100px">
            </div>
        <div>
            {!! $user->profile->about !!}
        </div>

    </div>

@endsection
