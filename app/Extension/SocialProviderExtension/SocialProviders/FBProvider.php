<?php
/**
 * Created by PhpStorm.
 * User: dmitriev
 * Date: 01.08.2018
 * Time: 18:10
 */

namespace App\Extension\SocialProviderExtension\SocialProviders;
use Laravel\Socialite\Facades\Socialite;

class FBProvider extends BaseProvider {

	protected function handleRequest($request){
		$data = array(
			'user_id'    => isset( $request->user['id'] ) ? $request->user['id'] : null,
			'email'      => isset( $request->user['email'] ) ? $request->user['email'] : null,
			'nickname'   => isset( $request->user['nickname'] ) ? $request->user['nickname'] : null,
			'first_name' => isset( $request->user['first_name'] ) ? $request->user['first_name'] : null,
			'last_name'  => isset( $request->user['last_name'] ) ? $request->user['last_name'] : null,
			'gender'     => isset( $request->user['gender'] ) ? $request->user['gender'] : null,
			'birthday'   => isset( $request->user['birthday'] ) ? str_replace( '/', '.', $request->user['birthday'] ) : null,
			'location'   => isset( $request->user['location']['name'] ) ? $request->user['location']['name'] : null,
			'avatar'     => isset( $request->avatar ) ? str_replace( '?type=normal', '?width=1920', $request->avatar ) : null,
		);

		return $data;
	}

	protected  function  getRequest() {
		return Socialite::with( 'facebook' )
		                           ->scopes([ 'email', 'user_gender', 'user_birthday', 'user_location' ] )
		                           ->fields( [ 'id', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'location' ] )
		                           ->user();
	}

}