<?php

/**
 * Created by PhpStorm.
 * User: petun
 * Date: 09.11.15
 * Time: 23:48
 */
class ResourceTest extends PHPUnit_Framework_TestCase
{

	public function testGetSerializedData() {
		$resource = new \IpadSlider\Model\Resource();
		$resource->type = 'instagram';
		$resource->params = 'fuck string';
		$resource->name = 'test';
		$resource->url = 'http://google.com';

		$data = $resource->getSerializedData();

		$this->assertNotEmpty($data);
	}

}