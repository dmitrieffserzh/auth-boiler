<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
	'news'      => News::class
]);

class Like extends Model {

	use SoftDeletes;

	protected $fillable = [
		'user_id',
		'content_id',
		'content_type'
	];
	protected $dates = ['deleted_at'];

	// RELATIONS
	public function contentTypes() {
		return $this->morphedTo();
	}
}
