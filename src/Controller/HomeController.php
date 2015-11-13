<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 12.11.2015
 * Time: 15:23
 */

namespace IpadSlider\Controller;
use IpadSlider\Application;

class HomeController extends BaseController {

	public function index() {
		echo Application::getInstance()->jadeEngine()->render(
			$this->appPath()  . '/frontend/src/jade/index.jade',
			['slides' => $this->_db->getAllSlides()]
		);
	}

}