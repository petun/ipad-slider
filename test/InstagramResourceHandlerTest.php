<?php
use IpadSlider\Application;
use IpadSlider\Handler\InstagramResourceHandler;

/**
 * Created by PhpStorm.
 * User: petun
 * Date: 01.11.15
 * Time: 0:23
 */

class InstagramResourceHandlerTest extends PHPUnit_Framework_TestCase {

	public function testFetchData() {

		Application::getInstance()->init();
		$h = new InstagramResourceHandler('');

		$this->assertTrue($h->fetchData());
	}

	public function testRenderHtml() {
		Application::getInstance()->init();
		$h = new InstagramResourceHandler('');

		$h->fetchData();
		$html = $h->renderHtml();

		$this->assertContains('instagram', $html);
		$this->assertContains('instagram-item__title', $html);
	}

	public function testRenderSmallHtml() {
		Application::getInstance()->init();
		$h = new InstagramResourceHandler('');
		$h->style = 'small';

		$h->fetchData();
		$html = $h->renderHtml();

		$this->assertContains('instagram -small', $html);
		$this->assertContains('instagram-item__image', $html);
	}
}