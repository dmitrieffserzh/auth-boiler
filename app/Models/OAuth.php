<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OAuth extends Model {

	protected $table = 'social_logins';

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