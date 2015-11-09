<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:43
 */

namespace IpadSlider\Handler;


use IpadSlider\Application;
use IpadSlider\Helper\StrHelper;
use Jade\Jade;
use Jenssegers\Date\Date;
use Vinelab\Rss\Article;
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
			$result[] =$this->_getFromArticle($article);
		}

		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/rss.jade', ['articles' => $result]);
	}

	private function _getFromArticle(Article $article) {
		$img = StrHelper::getImgSrcFromHtml($article->description);
		return [
			'link' => $article->link,
			'pubDate' => Date::parse($article->pubDate)->ago(),
			'title' => $article->title,
			'description' => StrHelper::wordWrap($article->description),
			'img' => $img
		];
	}

	private function _stripTags($str) {

	}
}
