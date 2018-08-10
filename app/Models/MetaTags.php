<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
	'news'  => News::class,
	'category'  => Category::class,
]);

class MetaTags extends Model {





	// RELATIONS
	public function contentTypes() {
		return $this->morphedTo();
	}

	public function seoNested() {
		return $this->hasMany(self::class,'id','parent_id');
	}
}
