<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;

class ServiceController extends Controller {


	// GENERATE RSS TO YANDEX TURBOPAGE
	public function rssTurbo() {
		$contents = view('service.rss.xml')->with('rss', News::orderBy('created_at', 'desc')->take(20)->get());
		return response($contents)->header('Content-Type','application/xml; charset=UTF-8');
	}


	// GENERATE SITEMAP
	public function sitemap() {
		$contents = view('service.sitemap.xml', [
			'news' =>  News::get(),
			'page' =>  Page::get()
		]);
		return response($contents)->header('Content-Type','application/xml; charset=UTF-8');
	}
}
