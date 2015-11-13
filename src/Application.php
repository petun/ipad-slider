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
use IpadSlider\Model\DbPersistent;
use IpadSlider\Model\DummyPersistent;
use IpadSlider\Transport\CurlTransport;
use Jade\Jade;
use Jenssegers\Date\Date;

class Application
{

	private static $_instance;

	private $_config;

	/* @var Jade */
	private $_jade;

	/* @var IServiceLocator */
	private $_serviceLocator;

	private function __construct() {
		$this->_config = require_once(dirname(__FILE__) . '/../app/config.php');

	}

	public function init() {
		Date::setLocale('ru');
		$this->_initServiceLocator();
	}

	public function getBasePath() {
		return __DIR__ . '/..';
	}


	public function handleRequest($request) {
		$controller = 'home';
		$action = 'index';
		if (isset($request['controller'])) {
			$controller = $request['controller'];
		}

		if (isset($request['action'])) {
			$action = $request['action'];
		}

		$controllerClassName = '\\IpadSlider\\Controller\\' . ucfirst($controller)  . 'Controller';
		if (class_exists($controllerClassName)) {
			$c = new $controllerClassName();
			$c->{$action}($request);

		} else {
			throw new \Exception("Class " . $controllerClassName . ' not exists');
		}
	}


	/**
	 * prevent the instance from being cloned
	 *
	 * @return void
	 */
	private function __clone() {
	}

	/**
	 * prevent from being unserialized
	 *
	 * @return void
	 */
	private function __wakeup() {
	}


	/**
	 * @return Application
	 */
	public static function getInstance() {
		if (null === static::$_instance) {
			static::$_instance = new static;
		}
		return static::$_instance;
	}

	private function _initServiceLocator() {
		$this->_serviceLocator = new ServiceLocator();
		$this->_serviceLocator->addService('IPersistent', new DbPersistent($this->_config['database']));
		$this->_serviceLocator->addService('IHttpTransport', new CurlTransport());
	}

	public function getService($service) {
		return $this->_serviceLocator->get($service);
	}

	public function config($key) {
		return $this->_config[$key];
	}

	/**
	 * @return Jade
	 */
	public function jadeEngine() {
		if (empty($this->_jade)) {
			$this->_jade =  new Jade(array(
				'prettyprint' => false,
				'extension' => '.jade',
			));
		}

		return $this->_jade;
	}

} 