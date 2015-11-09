<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 24.10.15
 * Time: 0:10
 */

namespace IpadSlider\Model;


use Jasny\MySQL\DB;

class DbPersistent implements IPersistent
{

	public function __construct($databaseConfig = []) {
		$this->_db = new DB(
			$databaseConfig['host'], $databaseConfig['user'], $databaseConfig['password'], $databaseConfig['database']
		);
	}

	public function getAllResources() {
		$resources = $this->_db->fetchAll('SELECT id, name, type, url,refresh_date,params FROM resource');
		return $this->_arrayToObjects($resources, '\\IpadSlider\\Model\\Resource');
	}

	public function getAllSlides() {
		$resource = $this->_db->fetchAll(
			'SELECT s.id, s.position, s.resource_id, r.name, r.url, r.type, r.html, r.refresh_date, r.params FROM slide s JOIN resource r ON (s.resource_id = r.id) ORDER BY s.position'
		);

		$slides = [];
		foreach ($resource as $r) {

			/** @var Slide $slide */
			$slide = $this->_arrayToObjects([$r], '\\IpadSlider\\Model\\Slide', ['id', 'position'])[0];
			$slide->resource = $this->_arrayToObjects([$r], '\\IpadSlider\\Model\\Resource', ['name', 'url', 'type', 'html','refresh_date','params'])[0];
			$slides[] =  $slide;
		}

		return $slides;
	}

	public function changeHtml(Resource $resource, $content) {
		$data = (array)$resource;
		$data['html'] = $content;
		$data['refresh_date'] = date('Y-m-d H:i:s');

		return $this->_db->save('resource', $data);
	}

	private function _arrayToObjects($data, $objectClass, $fields = []) {
		return array_map(
			function ($element) use ($objectClass, $fields) {
				//todo need refactor
				$r = new $objectClass();
				foreach ($element as $key => $value) {

					if ($fields != []) {
						if (in_array($key, $fields)) {
							$r->{$key} = $value;
						}
					} else {
						$r->{$key} = $value;
					}
				}

				return $r;

			}, $data
		);
	}
}