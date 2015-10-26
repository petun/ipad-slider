<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 23.10.2015
 * Time: 15:54
 */

namespace IpadSlider\Transport;



class CurlTransport {

	/**
	 * @param $url
	 * @return string
	 */
	public function getUrlContents($url) {
		// create curl resource
		$ch = curl_init();

		// set url
		curl_setopt($ch, CURLOPT_URL, $url);

		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// disable cert verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// $output contains the output string
		$output = curl_exec($ch);

		// close curl resource to free up system resources
		curl_close($ch);

		return $output;
	}
}