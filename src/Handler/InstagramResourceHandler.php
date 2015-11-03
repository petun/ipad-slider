<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 01.11.15
 * Time: 0:20
 */

namespace IpadSlider\Handler;


use HeyUpdate\Emoji\Emoji;
use HeyUpdate\Emoji\EmojiIndex;
use Instagram\Instagram;
use IpadSlider\Application;
use IpadSlider\Helper\StrHelper;
use Jenssegers\Date\Date;

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
		$emoji = new Emoji(new EmojiIndex(), '//twemoji.maxcdn.com/36x36/%s.png');
		foreach ($media as $photo) {
			/** @var \Instagram\Media $photo */
			$data[] = [
				'image' => $photo->getLowResImage()->url,
				'user' => $photo->getUser()->getUserName(),
				'location' => $photo->getLocation() ? $photo->getLocation()->getName() : '',
				'date' => Date::parse($photo->getCreatedTime())->ago(),
				'caption' => $photo->getCaption() ? StrHelper::removeEmoji($photo->getCaption()->getText())  : '',
			];

			file_put_contents("test.txt", print_r($data,true));
		}

		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/instagram.jade', ['data' => $data]);
	}


}