<?php
session_start();
use core\DBConnector;
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

$action = isset($uriParts[1]) && $uriParts[1] !== '' && is_string($uriParts[1]) ? $uriParts[1] : 'index';
if(count($uriParts) === 2 && $controller == 'Post' && $uriParts[1] !== '') {
	$action = 'post';
}
$action = sprintf('%sAction', $action);
//var_dump($action);
$id = '';
if(isset($uriParts[2]) && is_int(intval($uriParts[2]))) {
	$id = $uriParts[2];
} elseif(isset($uriParts[1]) && is_int(intval($uriParts[1]))) {
	$id = $uriParts[1];
}
// echo "<br>";
// var_dump($uriParts);
// echo "<br>";
// var_dump($id);


$controller = sprintf('controller\%sController', $controller);
$controller = new $controller();
if($id !== '') {
	$controller->$action($id);
} else {
	$controller->$action();
}
$controller->render();