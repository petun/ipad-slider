<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 31.10.15
 * Time: 11:13
 */

namespace IpadSlider\Handler;


use IpadSlider\Application;
use IpadSlider\Transport\IHttpTransport;

class WeatherResourceHandler implements IResourceHandler{

	private $_wind;

	private $_temperature;

	private $_condition;

	private $_forecasts;

	private $_city;

	public function __construct($url) {
		$this->_url = $url;
	}

	public function fetchData() {
		$rss = $this->_getRss();


		if ($rss) {
			$xml = new \SimpleXMLElement($rss);
			// Ветер
			$tmp = $xml->xpath('/rss/channel/yweather:wind');
			if ($tmp === false) throw new \Exception("Error parsing XML.");
			$this->_wind = $tmp[0];

			// Текущая температура воздуха и погода
			$tmp = $xml->xpath('/rss/channel/item/yweather:condition');
			if ($tmp === false) throw new \Exception("Error parsing XML.");
			$tmp = $tmp[0];

			$this->_temperature = $tmp['temp'];
			$this->_condition = (int)$tmp['code'];

			$this->_forecasts = $xml->xpath('/rss/channel/item/yweather:forecast');

			//$this->condition_text = strtolower((string)$tmp['text']);

			$location = $xml->xpath('/rss/channel/yweather:location');
			$this->_city = (string)$location[0]['city'];

			return true;

		}
		return false;
	}

	/**
	 * Special for unit tests
	 * @param $prop
	 *
	 * @return mixed
	 */
	public function getProperty($prop) {
		return $this->{'_'.$prop};
	}

	public function renderHtml() {
		$data = [
			'city' => $this->_city,
			'code' => $this->_condition,
			'codeClass' => 'weather-icon-'.$this->_condition,
			'temperature' => $this->getTemp(),
			'wind' => $this->getWind(),
			'condition' => $this->_conditionName($this->_condition),
			'forecasts' => []
		];

		foreach ($this->_forecasts as $forecast) {
			$f = (array)$forecast;
			$f = $f['@attributes'];
			$f['code'] = (int)$f['code'];
			$f['codeClass'] = 'weather-icon-'.$f['code'];
			$f['condition'] = $this->_conditionName($f['code']);
			$data['forecasts'][] = $f;
		}


		return Application::getInstance()->jadeEngine()->render(__DIR__. '/../../frontend/src/jade/resource/weather.jade',
			['data' => $data]);

	}

	private function _getRss() {
		$service = Application::getInstance()->getService('IHttpTransport');

		/** @var IHttpTransport $service */
		return $service->getUrlContents($this->_url);
	}

	private function _conditionName($code) {
		$cond = array(
			0 => 'торнадо'
		, 1 => 'тропический шторм'
		, 2 => 'ураган'
		, 3 => 'сильная гроза'
		, 4 => 'грозы'
		, 5 => 'дождь со снегом'
		, 6 => 'дождь со снегом'
		, 7 => 'дождь со снегом'
		, 8 => 'изморозь'
		, 9 => 'небольшой дождь'
		, 10 => 'ледяной дождь'
		, 11 => 'дожди'
		, 12 => 'дожди'
		, 13 => 'порывы снега'
		, 14 => 'небольшой снег'
		, 15 => 'метель'
		, 16 => 'снег'
		, 17 => 'град'
		, 18 => 'мокрый снег'
		, 19 => 'dust'
		, 20 => 'туман'
		, 21 => 'haze'
		, 22 => 'smoky'
		, 23 => 'ветренно'
		, 24 => 'ветренно'
		, 25 => 'холодно'
		, 26 => 'облачно'
		, 27 => 'облачно'
		, 28 => 'облачно'
		, 29 => 'небольшая облачность'
		, 30 => 'небольшая облачность'
		, 31 => 'ясно'
		, 32 => 'солнечно'
		, 33 => 'fair (night)'
		, 34 => 'ясно'
		, 35 => 'дождь с градом'
		, 36 => 'жарко'
		, 37 => 'местами грозы'
		, 38 => 'местами грозы'
		, 39 => 'местами грозы'
		, 40 => 'местами дожди'
		, 41 => 'снег'
		, 42 => 'снег'
		, 43 => 'снегопад'
		, 44 => 'переменная облачность'
		, 45 => 'гроза'
		, 46 => 'снег'
		, 47 => 'местами грозы'
		, 3200 => 'недоступно'
		);
		return $cond[$code];
	}

	private function _normalizeTemp($num) {
		if ($num > 0) {
			$num = '+' . $num;
		}
		return (string)$num;
	}

	public function getWind() {
		$wind_chill = (int)$this->_wind['chill'];
		//$wind_direction = (int)$this->_wind['direction'];
		$wind_speed = (int)$this->_wind['speed'];
		return $wind_chill . ", " . $wind_speed . " км/ч";
	}
	public function getTemp() {
		return $this->_normalizeTemp($this->_temperature);
	}


}