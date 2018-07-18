<?php

namespace App;

use App\Models\SocialLogin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];






    // RELATIONS

	public function getProvider($provider) {
		return $this->providers->first(function (SocialLogin $item) use ($provider) {
			return $item->provider === $provider;
		});
	}

	public function providers() {
		return $this->hasMany(SocialLogin::class);
	}


}
