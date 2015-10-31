<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 31.10.15
 * Time: 11:16
 */

namespace IpadSlider\Transport;


interface IHttpTransport {

	public function getUrlContents($url);

}