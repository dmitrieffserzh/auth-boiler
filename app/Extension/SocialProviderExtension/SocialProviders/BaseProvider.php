<?php
/**
 * Created by PhpStorm.
 * User: dmitriev
 * Date: 01.08.2018
 * Time: 18:09
 */

namespace App\Extension\SocialProviderExtension\SocialProviders;

use Socialite;

abstract class BaseProvider {
	abstract protected  function  handleRequest($request);
	abstract protected function  getRequest();

	public function GetSocial(){
		return $this->handleRequest($this->getRequest());

	}
}