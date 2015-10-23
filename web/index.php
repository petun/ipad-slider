<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:11
 */

use IpadSlider\Application;
use IpadSlider\Model\IPersistent;
use Jade\Jade;

require_once("../vendor/autoload.php");

Application::getInstance()->init();

/* @var $p IPersistent */
$p = Application::getInstance()->getService('IPersistent');

$slides = $p->getAllSlides();


$jade = new Jade(array(
	'prettyprint' => true,
	'extension' => '.jade',
	//'cache' => __DIR__.'/../cache/'
));

echo $jade->render(__DIR__ . '/../frontend/src/jade/index.jade', ['slides' => $slides]);