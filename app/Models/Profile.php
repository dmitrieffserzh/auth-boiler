<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	protected $table = 'users_profiles';

	protected $fillable = [
		'name',
		'birth_date',
		'gender',
	];

	// RELATIONS
	public function user() {
		return $this->belongsTo(User::class);
	}
}
