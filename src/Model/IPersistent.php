<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:20
 */

namespace IpadSlider\Model;


interface IPersistent {

	public function __construct($config = []);

	public function getAllResources();

	public function getAllSlides();

	/**
	 * @param $id
	 * @return Slide
	 */
	public function getSlide($id);

	public function changeHtml(Resource $resource, $html);
}