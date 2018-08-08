@extends('app')

@section('content')

    <h1 class="h5">Главная страница</h1>
    <hr>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @guest

                            Авторизуйтесь
                        @else
                             {{ Auth::user()->name }}
                        @endguest

                    @if(isset($service))
                        @if($service == 'vkontakte')
                            <div class="title m-b-md">
                                Привет, <b>{{ $details->name}}</b>! <br>
                                <br> <img src="{{ $details->avatar }}" width="300px">
                            </div>
                        @endif


                        @if($service == 'facebook')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name']}} ! <br> Your email is : {{
                                $details->user['email'] }} <br> <img src="{{ $details->avatar_original }}" width="300px">
                            </div>
                        @endif

                        @if($service == 'instagram')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['username']}} ! <br>
                                <img src="{{ $details->user['profile_picture'] }}">

                            </div>
                        @endif
                    @endif
                </div>

@endsection
