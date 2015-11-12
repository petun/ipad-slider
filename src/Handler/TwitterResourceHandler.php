<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 11.11.2015
 * Time: 14:21
 */

namespace IpadSlider\Handler;


use IpadSlider\Application;
use IpadSlider\Helper\StrHelper;
use Jenssegers\Date\Date;
use TwitterAPIExchange;

class TwitterResourceHandler implements IResourceHandler {

	protected $_url;

	protected $_response;

	public function __construct($url) {
		$this->_url = $url;
	}

	public function fetchData() {
		$requestMethod = 'GET';
		$getfield = '';


		$twitter = new TwitterAPIExchange(Application::getInstance()->config('twitter'));
		$response = $twitter->setGetfield($getfield)
			->buildOauth($this->_url, $requestMethod)
			->performRequest(true, array(
				CURLOPT_SSL_VERIFYPEER => false
			));

		$this->_response = json_decode($response);


		return $this->_response != null;
	}

	public function renderHtml() {
		if ($this->_response) {

			$data = [];
			foreach ($this->_response as $tweet) {
				$data[] = [
					'userImage' => $tweet->user->profile_image_url,
					'userName' => $tweet->user->name,
					'created' =>  Date::parse($tweet->created_at)->ago(),
					'text' => StrHelper::removeEmoji($tweet->text),
					'source' => $tweet->source,
				];
			}

			return Application::getInstance()->jadeEngine()->render(Application::getInstance()->getBasePath() . '/frontend/src/jade/resource/twitter.jade', ['data' => $data]);
		}
	}
}