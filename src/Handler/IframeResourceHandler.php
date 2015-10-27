<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 28.10.15
 * Time: 0:14
 */

namespace IpadSlider\Handler;


use IpadSlider\Application;

class IframeResourceHandler implements  IResourceHandler{

	private $_url;

	public function __construct($url) {
		$this->_url = $url;
	}

	public function fetchData() {
		return true;
	}

	public function renderHtml() {
		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/iframe.jade', ['url' => $this->_url]);
	}
}