@extends('app')

@section('content')
    <div class="col-md-12">
                <h1 class="h5">{{ __('Login') }}</h1>

        <hr>


        @if ( $errors->first('user_exist')  == true )
            <h2>Хренушки! Пользователь с таким мылом уже существует</h2>
        @endif



                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>

</div>
<div class="col">
    <div class="row">
                    <a href="{{ route('oauth.login', 'facebook') }}" class="auth-social">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" class="feather feather-activity">
                            <path id="Facebook" d="m8.88408,5.07267c0,0.57619 0,3.14799 0,3.14799l-2.30632,0l0,3.84937l2.30632,0l0,11.43898l4.73766,0l0,-11.43866l3.17919,0c0,0 0.29775,-1.84574 0.44207,-3.86388c-0.41379,0 -3.60335,0 -3.60335,0s0,-2.23944 0,-2.63197c0,-0.39338 0.51655,-0.92253 1.02709,-0.92253c0.50959,0 1.5851,0 2.58126,0c0,-0.5241 0,-2.33497 0,-4.00741c-1.32983,0 -2.84275,0 -3.50963,0c-4.97141,-0.00027 -4.8543,3.85293 -4.8543,4.42812z" fill="#ffffff"/>
                        </svg>
                    </a>
                    <a href="{{ route('oauth.login', 'vkontakte') }}" class="auth-social">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" class="feather feather-activity">
                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#ffffff" d="m16.95542,11.61637c0.64018,0.62503 1.31587,1.21308 1.89005,1.90114c0.25363,0.30576 0.49377,0.62128 0.67746,0.97612c0.26029,0.50442 0.02454,1.0595 -0.42776,1.08963l-2.81157,-0.00127c-0.72515,0.06017 -1.30363,-0.23176 -1.79005,-0.72756c-0.38927,-0.3965 -0.74975,-0.81849 -1.12406,-1.22837c-0.15345,-0.16753 -0.31407,-0.32516 -0.50595,-0.44977c-0.38381,-0.24914 -0.71697,-0.17286 -0.9363,0.22745c-0.22339,0.40716 -0.27405,0.858 -0.296,1.31175c-0.03012,0.66205 -0.23024,0.83612 -0.89528,0.86643c-1.42126,0.06703 -2.7701,-0.14799 -4.02314,-0.86497c-1.10472,-0.63206 -1.96138,-1.52436 -2.70701,-2.53454c-1.45176,-1.96702 -2.56351,-4.12845 -3.56272,-6.35045c-0.22492,-0.50062 -0.06043,-0.76934 0.49193,-0.77886c0.91722,-0.01782 1.83431,-0.01655 2.7526,-0.00127c0.37279,0.00545 0.61958,0.21927 0.76351,0.57145c0.49624,1.22018 1.10345,2.38108 1.86563,3.45714c0.20297,0.28648 0.40994,0.57297 0.70467,0.77461c0.32605,0.22327 0.5743,0.14927 0.72769,-0.21395c0.09733,-0.2303 0.13994,-0.47836 0.16189,-0.72503c0.07267,-0.84861 0.08224,-1.69575 -0.04521,-2.54139c-0.07825,-0.52775 -0.37551,-0.86941 -0.90213,-0.96928c-0.26873,-0.05092 -0.22872,-0.15092 -0.0986,-0.3043c0.22599,-0.26455 0.43854,-0.42921 0.86224,-0.42921l3.1775,0c0.50023,0.09873 0.61133,0.32345 0.67981,0.8268l0.00273,3.52955c-0.00545,0.19486 0.09733,0.77309 0.4483,0.90206c0.2809,0.09181 0.46606,-0.1329 0.6346,-0.31102c0.76079,-0.80745 1.30376,-1.76171 1.78884,-2.74981c0.21528,-0.43448 0.40036,-0.88571 0.57975,-1.33655c0.1329,-0.33454 0.34146,-0.49916 0.7183,-0.49187l3.05817,0.00273c0.09067,0 0.18243,0.00133 0.27025,0.01636c0.51533,0.08782 0.65654,0.3095 0.49738,0.81272c-0.25079,0.78951 -0.73872,1.44745 -1.21581,2.10843c-0.51,0.70568 -1.05545,1.38721 -1.5612,2.09707c-0.46467,0.64824 -0.42776,0.97498 0.14946,1.538l0,0l0.00001,0zm0,0" id="XMLID_807_"/>
                        </svg>
                    </a>
                    <a href="{{ route('oauth.login', 'odnoklassniki') }}" class="auth-social">Одноклассники</a>
                    <a href="{{ route('oauth.login', 'instagram') }}" class="auth-social">Instagram</a>
    </div>
</div>
@endsection
