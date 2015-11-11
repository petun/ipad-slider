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

	public function testWordWrap() {

		$source = [
			'<p>Тестовый текст очень длинный и длинный и длинный и длинный и длинный и длинный и длинный и длинный. И потом еще текст текст текст11102л',
			'<p>Тестовый текст</p><div style="test"></div><div style="test"></div><div style="test"></div><div style="test"></div><div style="test"></div><div style="test"></div><div style="test"></div><p>А тут большой текст</p>',
			"1\nВторая строка\nТретья строка.ный и длинный и длинный и  ный и длинный и длинный и ный и длинный и длинный и "
		];



		foreach ($source as $s) {
			$result = StrHelper::wordWrap($s, 100);
			$length = mb_strlen($result);

			$this->assertTrue($length < 120 && $length > 10);
		}
	}


	public function testRemoveEmoji() {
		$text = '💙👆🏼🤗☺️';

		$result = StrHelper::removeEmoji($text);
		var_dump($result);
	}

}