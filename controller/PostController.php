<?php

namespace controller;
use models\PostModel;
use core\DBConnector;

class PostController extends BaseController
{
	public function indexAction()
	{
		$mLog = $this->isAuth();
		$this->title = "Список статей";
		$db = DBConnector::getInstance();
		$mPost = new PostModel($db);
		$posts = $mPost->getAll();

		$this->content = $this->build(__DIR__ . '/../views/posts.php',
		[
			'posts' => $posts,
			'mLog' => $mLog
		]
		);
	}
	public function postAction($id)
	{
		$this->title = "Статья";
		$mLog = $this->isAuth();
		$db = DBConnector::getInstance();
		$mPost = new PostModel($db);
		$post = $mPost->getById($id);
		$this->content = $this->build(__DIR__ . '/../views/post.php',
		[
			'post' => $post,
			'mLog' => $mLog
		]
		);
	}

	public function oneAction()
	{
		$this->title = "Статья";
		$id = $this->request->gets('id');
		$mLog = $this->isAuth();
		$db = DBConnector::getInstance();
		$mPost = new PostModel($db);
		$post = $mPost->getById($id);
		$this->content = $this->build(__DIR__ . '/../views/post.php',
		[
			'post' => $post,
			'mLog' => $mLog
		]
		);
	}

	public function editAction()
	{
		$mLog = $this->isAuth();
		$id = $this->request->gets('id');
		$this->title = "Редактировать";
		$mess = '';
			if (!isset($id)) {
				$mess = "404, такой статьи нет";
			}
			$db = DBConnector::getInstance();
			$mPost = new PostModel($db);
			$post = $mPost->getById($id);
			if($post == null) {
				$mess = "404, такой статьи нет";
				$msg = false;
			}
			if($mLog) {
				if ($this->request->isPost()) {
					$title = trim($_POST['title']);
					$content = trim($_POST['content']);
					if($title == '' || $content == '') {
						$msg = 'Заполните все поля';
					} elseif($title === $post['title']) {
						$query1 = $mPost->updateMessage($title, $content, $id);
						header("Location: /post/$id");
					} else {
						$mPost->deleteById($id);
						$query1 = $mPost->addMessage($title, $content);
						header("Location: /post/$query1");
					}
				}
			} else {
				// сообщить что только админ может
			}
			$this->content = $this->build(__DIR__ . '/../views/edit.php',
			[
				'post' => $post,
				'mLog' => $mLog,
			]
			);
	}

	public function addAction()
	{
		$mLog = $this->isAuth();
		if($mLog) {
			if (count($_POST) > 0) {
				$title = trim($_POST['title']);
				$text = trim($_POST['text']);
				$db = DBConnector::getInstance();
				$mPost = new PostModel($db);
				$this->title = "Добавление статьи";
				if($title == '' || $text == '') {
				$msg = 'Заполните все поля!';
				var_dump('123');
				} else {
						$query1 = $mPost->addMessage($title, $text);
						header("Location: /post/$query1");
					exit();
				}
			} else {
				$name = '';
				$text = '';
				$msg = '';
			}
		}
		$this->content = $this->build(__DIR__ . '/../views/add.php',
				[
					'mLog' => $mLog
				]
			);
	}
}