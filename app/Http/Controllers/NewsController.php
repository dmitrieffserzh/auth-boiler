<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Seo;
use Illuminate\Http\Request;

class NewsController extends Controller {


	public function index() {

		$title[] = 'Не работает заголовок';

		array_push($this->title,'fdfdf');

		return view('news.index', [
			'news' => News::latest()->paginate(15),
			'seo' => Seo::where('content_type', '=', 'news')->where('content_id', '=', '0')->firstOrFail()
		]);
	}


	public function show($category_slug, $slug) {
		$news = News::where('slug', $slug)->firstOrFail();
		if ($news->getCategory->slug != $category_slug) {
			abort(404);
		}


		//Event::fire( 'news.show', $news );
		return view('news.show', [
			'news' => $news,
			'seo' => Seo::with('seoNested')->where('content_id', '=', 0)->firstOrFail()
		]);
	}
}
