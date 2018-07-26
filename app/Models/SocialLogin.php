<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model {

	protected $fillable = [
		'user_id',
		'provider',
		'provider_id',
		'token',
	];


	// RELATIONS
	public function user() {
		return $this->belongsTo(User::class);
	}
}