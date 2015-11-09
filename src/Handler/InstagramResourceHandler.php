<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 01.11.15
 * Time: 0:20
 */

namespace IpadSlider\Handler;


use Instagram\Instagram;
use IpadSlider\Application;
use IpadSlider\Helper\StrHelper;
use Jenssegers\Date\Date;

class InstagramResourceHandler implements IResourceHandler {

	/* @var \Instagram\CurrentUser */
	private $_currentUser;

	public $style;

	public $limit;

	public function __construct($url) {

	}

	public function fetchData() {
		$instagram = new Instagram;
		$instagram->setAccessToken( Application::getInstance()->config('instagram_token') );
		$this->_currentUser = $instagram->getCurrentUser();
		return $this->_currentUser instanceof \Instagram\CurrentUser;
	}

	public function renderHtml() {
		$media = $this->_currentUser->getFeed();
		$data = [];

		foreach ($media as $photo) {
			/** @var \Instagram\Media $photo */
			$data[] = [
				'image' => $photo->getLowResImage()->url,
				'user' => $photo->getUser()->getUserName(),
				'location' => $photo->getLocation() ? $photo->getLocation()->getName() : '',
				'date' => Date::createFromTimestamp($photo->getCreatedTime())->ago(),
				'caption' => $photo->getCaption() ? StrHelper::removeEmoji($photo->getCaption()->getText())  : '',
			];
		}

		if ($this->limit) {
			$data = array_chunk($data, $this->limit)[0];
		}

		$template = $this->style ? 'instagram_' . $this->style : 'instagram';

		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/'.$template.'.jade', ['data' => $data]);
	}


}