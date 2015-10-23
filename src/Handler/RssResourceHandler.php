<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 23.10.15
 * Time: 23:43
 */

namespace IpadSlider\Handler;


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

	public function renderHtml() {
		$r =  print_r($this->_feed->info(), true);

		$articles = $this->_feed->articles();

		$r .= $articles->last()->title;



		return $r;
	}
}