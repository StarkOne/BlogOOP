<?php
session_start();
use core\DBConnector;
use core\Request;
use models\UserModel;
use models\PostModel;

function __autoload($classname) {
	include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}

$base = DBConnector::getInstance();
$uri = $_SERVER['REQUEST_URI'];
$uriParts = explode('/', $uri);
unset($uriParts[0]);
$uriParts = array_values($uriParts);

if (isset($_GET['log']) && $_GET['log'] === 'end') {
	unset($_SESSION['is_auth']);
	setcookie("login", "", time() - 100);
	setcookie("password", "", time() - 100);
}

$controller = isset($uriParts[0]) && $uriParts[0] !== '' ? $uriParts[0] : 'post';
switch ($controller) {
	case 'post':
		$controller = 'Post';
		break;
	case 'user':
		$controller = 'User';
		break;
	case 'login':
		$controller = 'Login';
		break;
	default:
		die('Error 404');
		break;
}
$id = false;
if(is_numeric($uriParts[1])){
	$id = $uriParts[1];
	$uriParts[1] = 'one';
} 
$action = isset($uriParts[1]) && $uriParts[1] !== '' && is_string($uriParts[1]) ? $uriParts[1] : 'index';
$action = sprintf('%sAction', $action);


if(!$id) {
	if(isset($uriParts[2]) && is_numeric($uriParts[2])) {
		$id = $uriParts[2];
	} else {
		$id = false;
	}
}

if($id) {
	$_GET['id'] = $id;
}
$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);

$controller = sprintf('controller\%sController', $controller);
$controller = new $controller($request);
// if($id !== '') {
// 	$controller->$action($id);
// } else {
// 	$controller->$action();
// }
$controller->$action();
$controller->render();