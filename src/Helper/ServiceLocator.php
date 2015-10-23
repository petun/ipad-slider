<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:19
 */

namespace IpadSlider\Helper;

class ServiceLocator implements  IServiceLocator {

	private $_storage = [];

	public function __construct() {
	}

	public function addService($name, $object) {
		$this->_storage[$name] = $object;


	}

	public function get($service) {
		if ($this->_storage[$service]) {
			return $this->_storage[$service];
		}
		return null;
	}


}