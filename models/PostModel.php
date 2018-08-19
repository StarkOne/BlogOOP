<?php

namespace models;
use core\DBDriver;
class PostModel extends BaseModel
{
	protected $idTable = 'id';
	public function __construct(DBDriver $db)
	{
		parent::__construct($db, 'posts');
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