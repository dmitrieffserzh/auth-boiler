@extends('app_sidebar')

@section('content')

    <div class="h3">Настройки</div>
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
