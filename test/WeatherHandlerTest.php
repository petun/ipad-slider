<?php
use IpadSlider\Application;
use IpadSlider\Handler\WeatherResourceHandler;

/**
 * Created by PhpStorm.
 * User: petun
 * Date: 31.10.15
 * Time: 11:05
 */

class WeatherHandlerTest extends  PHPUnit_Framework_TestCase {

	/**
	 *
	 */
	public function testFunctionality()  {
		Application::getInstance()->init();

		$w = new WeatherResourceHandler('http://weather.yahooapis.com/forecastrss?w=2124390&u=c');

		$this->assertTrue($w->fetchData());

		$this->assertEquals('Vyksa', $w->getProperty('city'));

		$html = $w->renderHtml();

		$this->assertContains('weather__today', $html);
		$this->assertContains('weather__code', $html);




	}

}