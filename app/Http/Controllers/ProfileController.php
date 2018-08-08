<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

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


	public function settings($id) {
		return view('users.profile_settings', [
			'user' => User::findOrFail($id)
		]);
	}

	public function settings_store(Request $request, $id) {

    	$user = User::findOrFail($id);

		$user->update($request->all());

		return redirect()->back()->with(['status' => 'Профиль успешно обновлен!']);

	}
}
