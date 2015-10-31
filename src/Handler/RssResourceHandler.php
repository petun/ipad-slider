<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:43
 */

namespace IpadSlider\Handler;


use IpadSlider\Application;
use Jade\Jade;
use Vinelab\Rss\Rss;

class RssResourceHandler implements IResourceHandler {

	private $_url;

	private $_feed;


	public function __construct($url) {
		$this->_url = $url;
	}

	public function fetchData() {
		$rss = new Rss();
		$this->_feed = $rss->feed($this->_url, 'xml');
		return $this->_feed != null;
	}


	/**
	 * @return mixed|string
	 * @throws \Exception
	 */
	public function renderHtml() {
		$articles = $this->_feed->articles();
		$result = [];
		foreach ($articles as $i => $article) {
			if ($i >=4 ) {break;}

			$result[] = [
'link' => $article->link,
				'pubDate' => $article->pubDate,
				'title' => $article->title,
				'description' => $this->_stripTags($article->description)
			];
		}

		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/rss.jade', ['articles' => $result]);
	}

	private function _stripTags($str) {
		$r =  trim(strip_tags($str));
		$length = 200;

		if (mb_strlen($str, 'utf8') > $length) {
			$ww = wordwrap($r, $length, "\n");
			$shortenedString = substr($ww, 0, strpos($ww, "\n")).'...';

			return $shortenedString;

		} else {
			return $r;
		}
	}
}
