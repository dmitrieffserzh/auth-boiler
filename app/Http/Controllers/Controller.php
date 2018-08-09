<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $title = [];
	public $description = 'desc';

    public function __construct() {

    	array_push($this->title, env('APP_NAME'));

    	view()->share('title', $this->title);
    	view()->share('description', $this->description );
    }
}
