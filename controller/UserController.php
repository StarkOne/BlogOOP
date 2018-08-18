<?php

namespace controller;
use models\UserModel;
use core\DBConnector;

class UserController extends BaseController
{
	public function indexAction()
	{
		$this->title = "Авторизация";
		$db = DBConnector::getInstance();
		$mUser = new UserModel();
		$users = $mUser->getAll();

		$this->content = $this->build(__DIR__ . '/../views/posts.php',
		[
			'posts' => $posts
		]
		);
	}

}