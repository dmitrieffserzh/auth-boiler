<?php

namespace App\Extension\SocialProviderExtension\SocialProviders;

use Socialite;

abstract class BaseProvider {
	abstract protected function handleRequest($request);
	abstract protected function getRequest();

	public function GetSocial(){
		return $this->handleRequest($this->getRequest());
	}
}