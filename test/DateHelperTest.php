<?


use Jenssegers\Date\Date;

class DateHelperText extends PHPUnit_Framework_TestCase {

	public function setup() {
		Date::setLocale('ru');
	}

	public function testDates() {
		$dates = [
			'3 Nov 2015',
			'11/03/2015',
			'2015-11-03',
			'Tue, 03 Nov 2015 13:40:06 +0300'
		];

		$needle = '3 ноября 2015';

		foreach ($dates as $date) {
			$this->assertEquals($needle, Date::parse($date)->format('j F Y'));
		}
	}

	public function testUnix() {
		$dates = [
			'1446552000',
		];

		$needle = '3 ноября 2015';

		foreach ($dates as $date) {
			$this->assertEquals($needle, Date::createFromTimestamp($date)->format('j F Y'));
		}


	}
}