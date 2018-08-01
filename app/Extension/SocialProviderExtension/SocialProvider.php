<?php

namespace App\Extension\SocialProviderExtension;

use App\Extension\SocialProviderExtension\SocialProviders\VKProvider;
use App\Extension\SocialProviderExtension\SocialProviders\FBProvider;

class SocialProvider {

	public function mappingRequest($service){
		$provider = null;
		switch ($service){
			case 'vkontakte':
				$provider = new VKProvider();
				break;
			case 'facebook':
				$provider = new FBProvider();
				break;
		}

		if(is_null($provider)) abort(403, 'Access denied');

		return $provider->GetSocial();
	}
}