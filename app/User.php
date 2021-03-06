<?php

namespace App;

use App\Models\OAuth;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;
	use SoftDeletes;

    protected $fillable = [
        'nickname',
	    'email',
	    'password',
	    'registration_ip',
	    'registration_user_agent',
	    'role',
    ];

    protected $hidden = [
        'password',
	    'remember_token',
	    'registration_ip',
	    'registration_user_agent',
    ];



    // FUNCTIONS
	// IS ADMIN
	public function is_admin() {
		if ( $this->role == 'admin' ) {
			return true;
		} else {
			return false;
		}
	}

	// IS ONLINE
	public function is_online() {
		return Cache::has( 'user-is-online-' . $this->id );
	}


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
