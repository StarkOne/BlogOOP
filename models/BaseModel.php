<?php

namespace models;
use core\DBDriver;

abstract class BaseModel
{
	protected $db;
	protected $table;

	public function __construct(DBDriver $db, $table)
	{
		$this->db = $db;
		$this->table = $table;
	}

	public function getAll()
	{
		$sql = "SELECT * FROM $this->table";
		return $this->db->select($sql, [], 'all' );
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM $this->table WHERE $this->idTable = :id";
		return $this->db->select($sql, ['id' => $id], 'one' );
	}
	public function deleteById($id)
	{
		$sql = "DELETE FROM $this->table WHERE $this->idTable = :id";
		return $this->db->select($sql, ['id' => $id], 'one' );
	}

		public function addMessage($params)
		{
			return $this->db->insert($this->table, $params);
		}

	protected function cheakError($query)
	{
		$info = $query->errorInfo();

		if($info[0] != \PDO::ERR_NONE) {
			exit($info[2]);
		}
	}
}