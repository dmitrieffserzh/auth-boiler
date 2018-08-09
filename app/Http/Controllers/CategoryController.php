<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seo;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
	}


	public function index( $category_slug ) {
		return view( 'news.index', [
			'news' => Category::where('slug', $category_slug )->firstOrFail()->getNews()->latest()->paginate(15),
			'seo'  => Seo::where('content_id', '=', '2')->get()
			//'seo'  => Seo::where('content_type', '=', 'category')->where('content_id', '=', '0')->firstOrFail()
		] );
	}
}
