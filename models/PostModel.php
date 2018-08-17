<?php

namespace models;

class PostModel extends BaseModel
{
	protected $idTable = 'id';
	public function __construct(\PDO $db)
	{
		parent::__construct($db, 'posts');
	}

	public function addMessage($name, $text)
	{
		$sql = "INSERT INTO $this->table (title, text) VALUES (:n, :t)";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'n' => $name,
				't' => $text
			]
		);
		$this->cheakError($query);
		$res = $this->db->lastInsertId();
		return $res;
	}
	public function updateMessage($title, $content, $id)
	{
		$sql = "UPDATE $this->table SET title = :n, text = :t WHERE $this->idTable = :id";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'n' => $title,
				't' => $content,
				'id' => $id
			]
		);
		$res = $this->db->lastInsertId();
		$this->cheakError($query);
		return $res;
	}
}