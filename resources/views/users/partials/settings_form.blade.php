<form method="POST" action="{{ route('users.profile.settings_store', $user->id) }}">

    @csrf

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('Никнейм') }}</label>

        <div class="col-md-4">
            <input id="nickname" type="text" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}"
                   name="nickname" value="{{ $user->nickname or '' }}" required autofocus>

            @if ($errors->has('nickname'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('nickname') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('Имя') }}</label>

        <div class="col-md-4">
            <input id="nickname" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                   name="first_name" value="{{ $user->profile->first_name or '' }}" required>

            @if ($errors->has('first_name'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('Фамилия') }}</label>

        <div class="col-md-4">
            <input id="nickname" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                   name="last_name" value="{{ $user->profile->last_name or '' }}" required>

            @if ($errors->has('last_name'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __('Обновить профиль') }}
    </button>

</form>