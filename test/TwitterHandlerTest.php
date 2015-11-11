<?php
use IpadSlider\Application;
use IpadSlider\Handler\TwitterResourceHandler;

/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 11.11.2015
 * Time: 14:31
 */

class TwitterHandlerTest extends PHPUnit_Framework_TestCase {

	public function testHandler() {
		Application::getInstance()->init();

		$h = new TwitterResourceHandler('https://api.twitter.com/1.1/statuses/home_timeline.json');
		$this->assertTrue($h->fetchData());

		$html = $h->renderHtml();
		$this->assertContains('twitter-item', $html);
	}

}
 