<?php

namespace App\Http\Controllers;

use App\Models\News;

class RssController extends Controller {

	public function rssTurbo() {
		$rss = News::latest()->paginate( 15 );
		return view('rss.turbo', compact('rss'));
	}
}
