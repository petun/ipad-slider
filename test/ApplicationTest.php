<?php
use IpadSlider\Application;

/**
 * Created by PhpStorm.
 * User: petun
 * Date: 31.10.15
 * Time: 11:24
 */

class ApplicationTest extends PHPUnit_Framework_TestCase {

	public function setup() {
		Application::getInstance()->init();
	}

	/**
	 *
	 */
	public function testServiceLocator() {
		$trans  = Application::getInstance()->getService('IHttpTransport');
		$this->assertInstanceOf('IpadSlider\Transport\CurlTransport', $trans);
	}

	public function testConfig() {
		$conf = Application::getInstance()->config('database');
		$this->assertTrue(is_array($conf));
	}

	public function testBasePath() {
		$conf = Application::getInstance()->getBasePath();
		var_dump($conf);
	}

	public function testHandleRequest() {
		$request = [];
		Application::getInstance()->handleRequest($request);

	}

}