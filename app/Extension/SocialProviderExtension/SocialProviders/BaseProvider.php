<?php

namespace App\Extension\SocialProviderExtension\SocialProviders;

abstract class BaseProvider {

	abstract protected function handleRequest($request);
	abstract protected function getRequest();

	public function GetSocial(){
		return $this->handleRequest($this->getRequest());
	}

	// FIELD HANDLERS
	protected function getField($request, $propName, $field1 = null, $field2 = null) {
		$refl = new \ReflectionClass($request);
		$props = $refl->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
		foreach ($props as $prop){

			if($prop->getName() == $propName) {

				$value = $prop->getValue($request);
				if(!is_null($field1) && !is_null($field2)){
					if(empty($value[$field1][$field2])) return null;

					return $value[$field1][$field2];

				} elseif(!is_null($field1)) {
					if(empty($value[$field1])) return null;

					return $value[$field1];

				} elseif (is_null($field1) && is_null($field2)){
					if(empty($value)) return null;

					return $value;
				}
			}
		}
		abort(403, 'Access denied');
	}
}