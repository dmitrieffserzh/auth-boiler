<?php

namespace App\Extension\SocialProviderExtension;

use App\Extension\SocialProviderExtension\SocialProviders;

class SocialProvider {

	public function mappingRequest($service){
		$provider = null;
		switch ($service){
			case 'vkontakte':
				$provider = new SocialProviders\VKProvider();
				break;
			case 'facebook':
				$provider = new SocialProviders\FBProvider();
				break;
		}

		if(is_null($provider)) abort(403, 'Access denied');

		return $provider->GetSocial();
	}
}