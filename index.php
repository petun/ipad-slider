<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:11
 */

use IpadSlider\Application;
use IpadSlider\Model\IPersistent;

require_once("vendor/autoload.php");

Application::getInstance()->init();

/* @var $p IPersistent */
$p = Application::getInstance()->getService('IPersistent');

$slides = $p->getAllSlides();

