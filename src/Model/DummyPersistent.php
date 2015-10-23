<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:20
 */

namespace IpadSlider\Model;


use IpadSlider\Factory\ResourceHandlerFactory;

class DummyPersistent implements IPersistent {


	/**
	 * @return array
	 */
	public function getAllResources() {
		$r = new Resource();
		$r->type = 'html';
		$r->name = 'Test Alex';
		$r->url = 'http://localhost/';

		$r2 = new Resource();
		$r2->type = 'rss';
		$r2->name = 'Rss Feed';
		$r2->url = 'http://localhost/feed.rss';

		return array(
			$r,
			$r2
		);
	}

	public function getAllSlides() {
		// TODO: Implement getAllSlides() method.
	}


	/**
	 * @param Resource $resource
	 * @param $html
	 * @return bool
	 */
	public function changeHtml(Resource $resource, $html) {
		return true;
	}
}