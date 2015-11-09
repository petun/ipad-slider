<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 09.11.15
 * Time: 23:30
 */

class ResourceHandlerFactoryTest extends  PHPUnit_Framework_TestCase {

	public function testGet() {

		$data = [
			[
				'name' => 'Instagram',
				'url' => 'http://google.com',
				'params' => ['style' => 'small']
			],
			[
				'name' => 'Instagram',
				'url' => 'http://google.com',
				'params' => [],
			]
		];

		foreach ($data as $r) {
			$a = \IpadSlider\Factory\ResourceHandlerFactory::get($r['name'], $r['url'], $r['params']);
			$this->assertInstanceOf('\IpadSlider\Handler\IResourceHandler', $a);
		}



	}


}