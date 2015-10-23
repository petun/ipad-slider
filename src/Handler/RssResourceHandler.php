<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:43
 */

namespace IpadSlider\Handler;


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
		foreach ($articles as $article) {
			$result[] = [
				'pubDate' => $article->pubDate,
				'title' => $article->title,
				'description' => $article->description
			];
		}



		$jade = new Jade(array(
			'prettyprint' => false,
			'extension' => '.jade',
		));


		return $jade->render(__DIR__. '/../../frontend/src/jade/resource/rss.jade', ['articles' => $result]);
	}
}