<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:10
 */

namespace IpadSlider;

use IpadSlider\Model\DummyPersistent;
use IpadSlider\Model\IPersistent;

class Fetcher
{

	public function processResources() {

		/* @var $p IPersistent */
		$p = Application::getInstance()->getService('IPersistent');

		$resources = $p->getAllResources();

		if ($resources) {
			/** @var \IpadSlider\Model\Resource $resource */
			foreach ($resources as $resource) {
				try {
					$data = $resource->getSerializedData();
					var_dump($data);
					$p->changeHtml($resource, $data);
				} catch (\Exception $exc) {
					echo $exc->getMessage();
					$p->changeHtml(
						$resource, Application::getInstance()->jadeEngine()->render(
						__DIR__ . '/../frontend/src/jade/resource/error.jade',
							['message' => $exc->getMessage(),
								'stack' => $exc->getTraceAsString()
							]
					)
					);

				}
			}
		}

	}

} 