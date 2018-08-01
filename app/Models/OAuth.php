<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OAuth extends Model {

	protected $table = 'users_oauth';

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