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
            {{ Auth::user()->nickname }}
            {{ Auth::user()->profile->name }}



            <img src="/{{ Auth::user()->profile->avatar }}" class="avatar">
        @endguest

    </div>

@endsection
