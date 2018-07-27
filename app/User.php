<?php

namespace App;

use App\Models\Profile;
use App\Models\OAuth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;
	use SoftDeletes;

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
		return $this->providers->first(function (OAuth $item) use ($provider) {
			return $item->provider === $provider;
		});
	}

	public function oAuth() {
		return $this->hasOne(OAuth::class);
	}

	public function profile() {
		return $this->hasOne(Profile::class);
	}
}
