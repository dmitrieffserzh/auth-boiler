<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model {

	protected $fillable = [
		'provider',
		'provider_id',
		'token',
	];
}