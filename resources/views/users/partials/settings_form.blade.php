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


    <div class="form-group row">
        <label for="birth_date" class="col-sm-2 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

        <div class="col-md-4">
            <input id="birth_date" type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                   name="birthday" value="{{ $user->profile->birthday or '' }}" required>

            @if ($errors->has('birthday'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group row">
        <label for="gender" class="col-sm-2 col-form-label text-md-right">{{ __('Пол') }}</label>

        <div class="col-md-4">
            <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender"
                    required>
                <option @if($user->profile->gender == 0)selected="selected"@endif>Выбрать</option>
                <option value="1" @if($user->profile->gender == 1)selected="selected"@endif>{{ __('Женский') }}</option>
                <option value="2" @if($user->profile->gender == 2)selected="selected"@endif>{{ __('Мужской') }}</option>
            </select>

            @if ($errors->has('gender'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="birth_date" class="col-sm-2 col-form-label text-md-right">{{ __('Город') }}</label>

        <div class="col-md-4">
            <input id="birth_date" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                   name="location" value="{{ $user->profile->location or '' }}" required>

            @if ($errors->has('location'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('О себе') }}</label>

        <div class="col-md-10">
            <textarea id="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" rows="5"
                      name="about">{{ $user->profile->about or '' }}</textarea>

            @if ($errors->has('about'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('about') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('Обновить профиль') }}
    </button>

</form>