<?php
use IpadSlider\Application;

/**
 * Created by PhpStorm.
 * User: petun
 * Date: 31.10.15
 * Time: 11:24
 */

class ApplicationTest extends PHPUnit_Framework_TestCase {

	/**
	 *
	 */
	public function testServiceLocator() {
		Application::getInstance()->init();

		$trans  = Application::getInstance()->getService('IHttpTransport');

		$this->assertInstanceOf('IpadSlider\Transport\CurlTransport', $trans);
	}

}