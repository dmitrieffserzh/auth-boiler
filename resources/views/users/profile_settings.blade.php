@extends('app_sidebar')

@section('content')

    <div class="card-header">Настройки</div>

    <div>
        @if (session('status'))
            <div class="alert alert-primary" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div>
            {!! $user->profile->about !!}
        </div>


        @include('users.partials.settings_form')


    </div>

@endsection
