<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 12.11.2015
 * Time: 15:33
 */

namespace IpadSlider\Controller;


use IpadSlider\Model\Slide;

class SlideController extends BaseController {

	public function get($request) {
		$slide = $this->_db->getSlide($request['id']);

		$result = false;
		if ($slide instanceof Slide) {
			$result = [
				'refresh_date' => $slide->resource->refresh_date,
				'html' => $slide->resource->html
			];
		}

		echo json_encode($result);
	}


} 