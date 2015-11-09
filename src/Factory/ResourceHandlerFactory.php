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
	public static function get($className, $url, array $parameters = []) {
		$fullClassName = '\\IpadSlider\\Handler\\' . ucfirst($className)  . 'ResourceHandler';
		if (class_exists($fullClassName)) {
			$result =  new $fullClassName($url);

			if ($parameters) {
				foreach ($parameters as $key => $value) {
					if (property_exists($fullClassName, $key)) {
						$result->{$key} = $value;
					}
				}
			}

			return $result;
		}

		throw new \Exception('Error. Class '.$fullClassName . ' not found');
	}

} 