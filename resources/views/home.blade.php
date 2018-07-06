@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if($service == 'vkontakte')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name']}} ! <br> Your email is : {{
    $details->user['email'] }} <br> You are {{ $details->user['gender'] }}.
                            </div>
                        @endif


                        @if($service == 'facebook')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name']}} ! <br> Your email is : {{
    $details->user['email'] }} <br> You are {{ $details->user['gender'] }}.
                            </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
