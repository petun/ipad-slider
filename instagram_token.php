<?

use Instagram\Auth;
use IpadSlider\Application;

require_once('vendor/autoload.php');

Application::getInstance()->init();

$auth = new Auth( Application::getInstance()->config('instagram') );


if ($_GET['code']) {
	echo 'Api token is <strong>' . $auth->getAccessToken( $_GET['code'] ) . '</strong>';
} else {
	$auth->authorize();
}