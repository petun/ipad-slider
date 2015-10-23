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

	public function changeHtml(Resource $resource, $html);
}