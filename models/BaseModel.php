<?php

namespace models;

abstract class BaseModel
{
	protected $db;
	protected $table;

	public function __construct(\PDO $db, $table)
	{
		$this->db = $db;
		$this->table = $table;
	}

	public function getAll()
	{
		$sql = "SELECT * FROM $this->table";
		$query = $this->db->prepare($sql);
		$query->execute();
		$this->cheakError($query);
		$res = $query->fetchAll();
		return $res;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM $this->table WHERE $this->idTable = :id";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'id' => $id
			]
		);
		$this->cheakError($query);
		$res = $query->fetch();
		return $res;
	}
	public function deleteById($id)
	{
		$sql = "DELETE FROM $this->table WHERE $this->idTable = :id";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'id' => $id
			]
		);
		$this->cheakError($query);
	}
	protected function cheakError($query)
	{
		$info = $query->errorInfo();

		if($info[0] != \PDO::ERR_NONE) {
			exit($info[2]);
		}
	}
}