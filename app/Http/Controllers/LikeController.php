<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller {

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function like( Request $request ) {

		$result     = $request->all();
		$like       = Like::withTrashed()->whereContentType( $result['type'] )->whereContentId( $result['id'] )->whereUserId( Auth::id() )->first();

		if ( is_null( $like ) ) {

			$like               = new Like();
			$like->user_id      = Auth::id();
			$like->content_id   = $result['id'];
			$like->content_type = $result['type'];
			$like->save();


		} else {

			if ( is_null( $like->deleted_at ) ) {
				$like->delete();
			} else {
				$like->restore();
			}

		}

		// LIKE COUNTER
		$like_count = Like::whereContentType( $result['type'] )->whereContentId( $result['id'] )->get()->count();

		return Response()->json( [
			'liked'      => is_null( $like->deleted_at ),
			'like_count' => $like_count
		] );
	}
}
