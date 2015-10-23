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

class Fetcher {

	public function processResources() {

		/* @var $p IPersistent */
		$p = Application::getInstance()->getService('IPersistent');

		$resources = $p->getAllResources();

		/** @var \IpadSlider\Model\Resource $resource */
		foreach ($resources as $resource) {
			if ($html = $resource->getSerializedData()) {
				echo $html;
				$p->changeHtml($resource, $html);
			} else {
				echo 'FAILED';
			}

		}
	}

} 