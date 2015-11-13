<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 12.11.2015
 * Time: 15:35
 */

namespace IpadSlider\Controller;


use IpadSlider\Application;
use IpadSlider\Model\IPersistent;

abstract class BaseController {

	/* @var IPersistent */
	protected $_db;

	public function __construct() {
		$this->_db = Application::getInstance()->getService('IPersistent');
	}


	//just shortcut
	protected function appPath() {
		return Application::getInstance()->getBasePath();
	}



} 