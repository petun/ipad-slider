<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 14:59
 */

namespace IpadSlider\Handler;

use IpadSlider\Transport\CurlTransport;

class HtmlResourceHandler implements IResourceHandler {

	protected $_url;

	protected $_content;

	/**
	 * @return false
	 */
	public function fetchData() {
		$t = new CurlTransport();
		$this->_content = $t->getUrlContents($this->_url);
		return true;
	}

	/**
	 * @return string
	 */
	public function renderHtml() {
		return $this->_content;
	}

	public function __construct($url) {
		$this->_url = $url;
	}
}