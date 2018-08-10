<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class RssController extends Controller {

	public function rssTurbo() {
		$rss = News::latest()->paginate( 15 );
		return view('rss.turbo', compact('rss'));
	}
}
