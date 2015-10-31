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

class InstagramResourceHandler implements IResourceHandler {

	/* @var \Instagram\CurrentUser */
	private $_currentUser;

	public function __construct($url) {

	}

	public function fetchData() {
		$instagram = new Instagram;
		$instagram->setAccessToken( Application::getInstance()->config('instagram_token') );
		$this->_currentUser = $instagram->getCurrentUser();
		return $this->_currentUser instanceof \Instagram\CurrentUser;
	}

	public function renderHtml() {
		$media = $this->_currentUser->getFeed(['count' => 3]);
		$data = [];
		foreach ($media as $photo) {
			/** @var \Instagram\Media $photo */
			$data[] = [
				'image' => $photo->getLowResImage()->url,
				'user' => $photo->getUser()->getUserName(),
				'location' => $photo->getLocation() ? $photo->getLocation()->getName() : '',
				'date' => $photo->getCreatedTime(),
				//'caption' => $photo->getCaption() ? $photo->getCaption()->getText() : '',
			];
		}

		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/instagram.jade', ['data' => $data]);
	}
}