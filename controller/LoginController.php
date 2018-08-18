<?php

namespace controller;
use models\LoginModel;
use core\DBConnector;

class LoginController extends BaseController
{
	public function indexAction()
	{
		$this->title = "Авторизация";
		$log = $this->isAuth();
		if($log) {
			header('Location: /');
			exit();
		}
		if (count($_POST) > 0) {
			$db = DBConnector::getInstance();
			$logMod = new LoginModel($db);
			$res = $logMod->checkAdmin();
			if ($_POST['login'] === $res['login'] && $_POST['password'] === $res['password']) {
				$_SESSION['is_auth'] = true;

				if (isset($_POST['remember'])) {
					setcookie('login', hash('sha256', $res['login']), time() + 3600 * 24 * 7, '');
					setcookie('password', hash('sha256', $res['password']), time() + 3600 * 24 * 7, '');
				}

				header('Location: /');
				exit();
			}
		}
		$this->content = $this->build(__DIR__ . '/../views/login.php');
	}

}