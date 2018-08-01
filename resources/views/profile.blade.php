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
            {{ Auth::user()->nickname }}
            {{ Auth::user()->profile->first_name }}
            {{ Auth::user()->profile->last_name }}
            {{ Auth::user()->profile->location }}
                    </div>
<div>
            <img src="/{{ Auth::user()->profile->avatar }}" class="avatar" width="300px">
</div>


            @endguest

    </div>

@endsection
