<?php

namespace App\Extension\SocialProviderExtension\SocialProviders;

use Laravel\Socialite\Facades\Socialite;

class FBProvider extends BaseProvider {

	protected function handleRequest($request){
		$data = array(
			'token'      => $this->getField($request, 'token'),
			'user_id'    => $this->getField($request, 'user', 'id'),
			'email'      => $this->getField($request, 'user', 'email'),
			'nickname'   => $this->getField($request, 'user', 'nickname'),
			'first_name' => $this->getField($request, 'user', 'first_name'),
			'last_name'  => $this->getField($request, 'user', 'last_name'),
			'location'   => $this->getField($request, 'user', 'location', 'name'),
			'gender'     => $this->handleGender(    $this->getField($request, 'user','gender')),
			'birthday'   => $this->handleBirthDate( $this->getField($request, 'user', 'birthday')),
			'avatar'     => $this->handleAvatar(    $this->getField($request, 'avatar')),
		);
		return $data;
	}

	protected function getRequest() {
		return Socialite::with('facebook')
		                           ->scopes([ 'email', 'user_gender', 'user_birthday', 'user_location' ] )
		                           ->fields( [ 'id', 'first_name', 'last_name', 'email', 'gender', 'birthday', 'location' ] )
		                           ->user();
	}


	// FIELD HANDLERS
	protected function handleBirthDate($date) {
		return date('d.m.Y', strtotime($date));
	}

	protected function handleAvatar($avatar) {
		return str_replace('?type=normal', '?width=1920', $avatar);
	}

	protected function handleGender($gender) {
		$result = null;
		switch ($gender) {
			case 'female':
				$result = '1';
				break;
			case 'male':
				$result = '2';
				break;
			default:
				$result = '0';
				break;
		}
		return $result;
	}
}