<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 14:58
 */

namespace IpadSlider\Handler;


interface IResourceHandler {
	public function __construct($url);

	public function fetchData();

	public function renderHtml();
} 