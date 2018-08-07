<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    public function __construct() {
        //$this->middleware('auth');
    }


	public function index() {
		return view( 'users.index', [
			'users' => User::orderBy('created_at', 'DESC')->paginate( 15 )
		] );
	}


	public function profile($id) {
		return view( 'users.profile', [
			'user' => User::findOrFail($id)
		] );
	}
}
