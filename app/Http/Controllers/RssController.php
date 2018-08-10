<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RssController extends Controller {


	public function rssTurbo() {
		$rss_feed = 'feed';
		return view('rss.turbo', compact('rss_feed'));
	}


}
