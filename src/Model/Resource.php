<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:01
 */

namespace IpadSlider\Model;
use IpadSlider\Factory\ResourceHandlerFactory;
use Jenssegers\Date\Date;

/**
 * Class Resource
 * @package IpadSlider\Model
 * @author Petr Marochkin <petun911@gmail.com>
 * @link http://petun.ru/
 * @copyright 2015, Petr Marochkin
 *
 */
class Resource {

	public $name;

	/* @var string */
	public $url;

	/* @var string */
	public $html;

	/* @var string */
	public $type;

	/* @var string */
	public $refresh_date;

	/* @var string */
	public $params;

	/**
	 * @return null
	 */
	public function getSerializedData() {
		$type = ResourceHandlerFactory::get($this->type, $this->url, $this->_getParams());
		if ($type->fetchData($this->url)) {
			return $type->renderHtml();
		}
		return null;
	}

	public function getAgo() {
		return Date::parse($this->refresh_date)->ago();
	}

	private function _getParams() {
		$json = json_decode($this->params, true);
		return $json ? $json : [];
	}

}