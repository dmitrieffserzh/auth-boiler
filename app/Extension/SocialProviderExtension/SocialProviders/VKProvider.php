<?php
/**
 * Created by PhpStorm.
 * User: dmitriev
 * Date: 01.08.2018
 * Time: 18:10
 */

namespace App\Extension\SocialProviderExtension\SocialProviders;
use Laravel\Socialite\Facades\Socialite;

class VKProvider extends BaseProvider {

	protected function handleRequest($request){
		$data = array(
			'user_id'    => isset( $request->user['id'] ) ? $request->user['id'] : null,
			'email'      => isset( $request->accessTokenResponseBody['email'] ) ? $request->accessTokenResponseBody['email'] : null,
			'nickname'   => isset( $request->user['nickname'] ) ? $request->user['nickname'] : null,
			'first_name' => isset( $request->user['first_name'] ) ? $request->user['first_name'] : null,
			'last_name'  => isset( $request->user['last_name'] ) ? $request->user['last_name'] : null,
			'gender'     => isset( $request->user['sex'] ) ? $request->user['sex'] : null,
			'birthday'   => isset( $request->user['bdate'] ) ? $request->user['bdate'] : null,
			'location'   => isset( $request->user['city']['title'] ) ? $request->user['city']['title'] : null,
			'avatar'     => isset( $request->user['photo_max_orig'] ) ? str_replace( '?ava=1', '', $request->user['photo_max_orig'] ) : null,
		);

		return $data;
	}

	protected  function  getRequest() {
		return Socialite::with( 'vkontakte' )
		                    ->scopes([ 'email', ])
		                    ->fields([ 'nickname', 'first_name', 'last_name', 'sex', 'bdate', 'city', 'photo_max_orig' ])
		                    ->user();
	}

}