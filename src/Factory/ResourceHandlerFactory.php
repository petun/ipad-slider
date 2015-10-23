<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:44
 */

namespace IpadSlider\Factory;


use IpadSlider\Handler\IResourceHandler;

class ResourceHandlerFactory {

	/**
	 * @param $className
	 * @param $url
	 * @return IResourceHandler
	 * @throws \Exception
	 */
	public static function get($className, $url) {
		$fullClassName = '\\IpadSlider\\Handler\\' . ucfirst($className)  . 'ResourceHandler';
		if (class_exists($fullClassName)) {
			return new $fullClassName($url);
		}

		throw new \Exception('Error. Class '.$fullClassName . ' not found');
	}

} 