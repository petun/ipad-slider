<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:11
 */

use IpadSlider\Application;

require_once("vendor/autoload.php");

Application::getInstance()->init();

$job = new IpadSlider\Fetcher();
$job->processResources();