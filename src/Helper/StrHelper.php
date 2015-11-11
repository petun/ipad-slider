<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 03.11.2015
 * Time: 16:34
 */

namespace IpadSlider\Helper;

use IpadSlider\Application;
use Sunra\PhpSimple\HtmlDomParser;

class StrHelper {

	public static function removeEmoji($data) {

		require_once(Application::getInstance()->getBasePath(). '/php-emoji/emoji.php');

		$data = emoji_docomo_to_unified($data);   # DoCoMo devices
		$data = emoji_kddi_to_unified($data);     # KDDI & Au devices
		$data = emoji_softbank_to_unified($data); # Softbank & pre-iOS6 Apple devices
		$data = emoji_google_to_unified($data);   # Google Android devices


		$data = emoji_unified_to_html($data);

		$data = preg_replace( '/[^а-яa-z0-9 _\-\+\&\.\,\!@#\$\n\t<>=\/"\(\)\*]/ui', '',$data);

		return $data;
	}

	public static function getImgSrcFromHtml($html, $default = '') {
		$dom = HtmlDomParser::str_get_html( $html );
		$images = $ret = $dom->find('img');
		if ($images) {
			return $images[0]->src;
		}
		return $default;
	}

	public static function wordWrap($str, $length = 200) {
		$r =  trim(strip_tags($str));
		$r = str_replace("\n"," ", $r);


		if (mb_strlen($r, 'utf8') > $length) {

			$ww = wordwrap($r, $length, "\n");
			$shortenedString = substr($ww, 0, strpos($ww, "\n")).'...';

			return $shortenedString;

		} else {
			return $r;
		}
	}

} 