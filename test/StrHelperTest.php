<?php


use IpadSlider\Helper\StrHelper;

class StrHelperText extends PHPUnit_Framework_TestCase {

	public function testGetImgSrcFromHtml() {

		$source = [
			'<p>Another test</p><p><img src="test.jpg" alt="" /></p>',
			"<img src='test.jpg'/></p>",
			"<p>Русский текст</p><p><img src='test.jpg' alt='' /></p>",
			//'This is just text. No image here',
		];

		$needle = 'test.jpg';

		foreach ($source as $s) {
			$result = StrHelper::getImgSrcFromHtml($s, 'noimg.jpg');
			$this->assertEquals($needle, $result);
		}
	}

}