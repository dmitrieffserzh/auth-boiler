<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller {

	public function getPage($slug) {
		$page = Page::where( 'slug', $slug )->firstOrFail();

		return view( 'pages.default', [
			'page' => $page
		]);
	}

}
