<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:21
 */

namespace IpadSlider\Helper;


interface IServiceLocator {

	public function addService($name, $object);

	public function get($service);

}