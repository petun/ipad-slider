<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 14:55
 */

namespace IpadSlider;


use IpadSlider\Helper\IServiceLocator;
use IpadSlider\Helper\ServiceLocator;
use IpadSlider\Model\DummyPersistent;

class Application {

	private static $_instance;

	private $_config;

	/* @var IServiceLocator */
	private $_serviceLocator;

	private function __construct() {
		$this->_config = require_once(dirname(__FILE__).'/../app/config.php');
		$this->_initServiceLocator();
	}

	/**
	 * prevent the instance from being cloned
	 *
	 * @return void
	 */
	private function __clone()
	{
	}
	/**
	 * prevent from being unserialized
	 *
	 * @return void
	 */
	private function __wakeup()
	{
	}


	public static function getInstance() {
		if (null === static::$_instance) {
			static::$_instance = new static;
		}
		return static::$_instance;
	}

	private function _initServiceLocator() {
		$this->_serviceLocator = new ServiceLocator();
		$this->_serviceLocator->addService('IPersistent', new DummyPersistent());
	}

	public function getService($service) {
		return $this->_serviceLocator->get($service);
	}

} 