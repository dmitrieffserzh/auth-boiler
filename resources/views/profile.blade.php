@extends('app')

@section('content')

    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @guest

            Авторизуйтесь
        @else
                <div>
                    <strong style="display:block"><strong>@</strong>{{ Auth::user()->nickname }}</strong>
                    <span>{{ Auth::user()->profile->first_name }} </span>
                    <span>{{ Auth::user()->profile->last_name }}</span>
                    <span style="display:block">{{ Auth::user()->profile->location }}</span>
                </div>
<div>
            <img src="/{{ Auth::user()->profile->avatar }}" class="avatar" width="300px">
</div>


            @endguest

    </div>

@endsection
