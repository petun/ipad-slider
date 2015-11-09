<?php
/**
 * Created by PhpStorm.
 * User: marochkin_pe
 * Date: 03.11.2015
 * Time: 16:34
 */

namespace IpadSlider\Helper;


use Sunra\PhpSimple\HtmlDomParser;

class StrHelper {

	public static function removeEmoji($text) {

		$clean_text = "";

		// Match Emoticons
		$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
		$clean_text = preg_replace($regexEmoticons, '', $text);

		// Match Miscellaneous Symbols and Pictographs
		$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
		$clean_text = preg_replace($regexSymbols, '', $clean_text);

		// Match Transport And Map Symbols
		$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
		$clean_text = preg_replace($regexTransport, '', $clean_text);

		// Match Miscellaneous Symbols
		$regexMisc = '/[\x{2600}-\x{26FF}]/u';
		$clean_text = preg_replace($regexMisc, '', $clean_text);

		// Match Dingbats
		$regexDingbats = '/[\x{2700}-\x{27BF}]/u';
		$clean_text = preg_replace($regexDingbats, '', $clean_text);

		return $clean_text;
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