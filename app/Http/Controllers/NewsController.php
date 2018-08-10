<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
	}


	public function index() {
		return view( 'news.index', [
			'news' => News::latest()->paginate( 15 ),
		]);
	}


	public function category( $category ) {
		return view( 'news.index', [
			'news' => Category::where( 'slug', $category )->firstOrFail()->getNews()->latest()->paginate( 15 ),
		]);
	}


	public function show( $category, $slug ) {
		$news = News::where( 'slug', $slug )->firstOrFail();
		if ( $news->getCategory->slug != $category ) {
			abort( 404 );
		}

		//Event::fire( 'news.show', $news );
		return view( 'news.show', [
			'news' => $news,
		]);
	}





//	public function categories($category_slug, Request $request) {
//
//		$categories = explode('/', $category_slug);
//
//		//$postSlug = array_pop($categories);
//		$category = Category::whereIn('slug', $categories)->get();
//		$posts = $category->loadMissing('getNews');
//
//		foreach ($posts as $post) {
//			foreach ($post->getNews as $news) {
//				print_r($news);
//			}
//		}
//				dd($request);
//	}


}
