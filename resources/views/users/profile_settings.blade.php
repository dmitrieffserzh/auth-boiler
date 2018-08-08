@extends('app_sidebar')

@section('content')

    <h1 class="h5">Настройки</h1>
    <hr>
    <div>
        @if (session('status'))
            <div class="alert alert-primary" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @include('users.partials.settings_form')


    </div>

@endsection
