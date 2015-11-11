<?

/*use IpadSlider\Application;

require_once('vendor/autoload.php');

Application::getInstance()->init();


$url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
$requestMethod = 'GET';
$getfield = '';


$twitter = new TwitterAPIExchange(Application::getInstance()->config('twitter'));
$response = $twitter->setGetfield($getfield)
	->buildOauth($url, $requestMethod)
	->performRequest(true, array(
		CURLOPT_SSL_VERIFYPEER => false
	));

var_dump(json_decode($response));*/