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
					echo "Get resource  - " . $resource->name . "\n";
					$data = $resource->getSerializedData();
					$p->changeHtml($resource, $data);
					echo "Done \n";
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