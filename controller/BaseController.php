<?php

namespace controller;
use models\LoginModel;
use core\DBConnector;

class BaseController
{
	protected $title;
	protected $content;
	protected $is_auth;

	public function __construst()
	{
		$this->title = 'Статьи';
		$this->content = '';
		$this->is_auth = false;
	}

	protected function isAuth()
	{
		$db = DBConnector::getPDO();
		$log = new LoginModel($db);
		$rez = $log->checkAdmin();
		if($_SESSION['is_auth'] !== '' && isset($_SESSION['is_auth'])) {
			$this->is_auth = true;
		} elseif(isset($_COOKIE['login']) && isset($_COOKIE['password']))  {
			if ($_COOKIE['login'] === $res['login'] && $_COOKIE['password'] === $res['password']){
					$this->is_auth = true;
				}
		}
		return $this->is_auth;
	}

	public function render()
	{
		echo $this->build(
			__DIR__ . '/../views/main.php', 
			[
			'title' => $this->title,
			'content' => $this->content
			]);
	}

	protected function build($template, $params = [])
	{
		ob_start();
		extract($params);
		include_once $template;
		return ob_get_clean();
	}
}