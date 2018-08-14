<?php

namespace App\Models;

use Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model {

	protected $dateFormat = 'U';

	public $type = 'news';

	public $fillable = [
		'slug',
		'title',
		'content',
		'user_id',
		'category_id',
		'published',
		'created_at',
		'updated_at'
	];

	public $dates = [
		'created_at',
		'updated_at'
	];

	public function getRouteKeyName() {
		return 'slug';
	}

	public function getLikedAttribute() {
		$like = $this->like()->where('user_id', Auth::id())->first();
		return !is_null($like);
	}

	// RELATIONS
	public function getAuthor() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function getCategory() {
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function getSeo() {
		return $this->morphMany(Seo::class, 'content');
	}

	public function like() {
		return $this->morphMany(Like::class, 'content');
	}
}
