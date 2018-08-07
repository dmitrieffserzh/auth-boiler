<?php

namespace App\Extension\SocialProviderExtension\SocialProviders;

use Laravel\Socialite\Facades\Socialite;

class VKProvider extends BaseProvider {

	protected function handleRequest($request){
		$data = array(
			'token'      => $this->getField($request, 'token'),
			'user_id'    => $this->getField($request, 'user', 'id'),
			'email'      => $this->getField($request, 'accessTokenResponseBody', 'email'),
			'nickname'   => $this->getField($request, 'user', 'nickname'),
			'first_name' => $this->getField($request, 'user', 'first_name'),
			'last_name'  => $this->getField($request, 'user', 'last_name'),
			'location'   => $this->getField($request, 'user', 'city', 'title'),
			'gender'     => $this->getField($request, 'user', 'sex'),
			'birthday'   => $this->handleBirthDate( $this->getField($request, 'user', 'bdate')),
			'avatar'     => $this->handleAvatar(    $this->getField($request, 'user', 'photo_max_orig')),
		);
		return $data;
	}

	protected function getRequest() {
		return Socialite::with( 'vkontakte' )
		                    ->scopes([ 'email' ])
		                    ->fields([ 'nickname', 'first_name', 'last_name', 'sex', 'bdate', 'city', 'photo_max_orig' ])
		                    ->user();
	}


	// FIELD HANDLERS
	protected function handleBirthDate($date) {
		return date('d.m.Y', strtotime($date));
	}

	protected function handleAvatar($avatar) {
		return str_replace( '?ava=1', '', $avatar);
	}
}