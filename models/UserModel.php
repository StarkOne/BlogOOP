<?php

namespace models;
use core\DBDriver;
class UserModel extends BaseModel
{
	protected $idTable = 'id_users';
	public function __construct(DBDriver $db)
	{
		parent::__construct($db, 'users');
	}

	public function addUser($login, $password)
	{
		$sql = "INSERT INTO $this->table (login, password) VALUES (:n, :t)";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'n' => $login,
				't' => $password
			]
		);
		$this->cheakError($query);
		$res = $this->db->lastInsertId();
		return $res;
	}
	public function updateUser($login, $password, $id)
	{
		$sql = "UPDATE $this->table SET login = :n, `password`= :t WHERE $this->idTable = :id";
		$query = $this->db->prepare($sql);
		$query->execute(
			[
				'n' => $login,
				't' => $password,
				'id' => $id
			]
		);
		$this->cheakError($query);
		$res = $this->db->lastInsertId();
		return $res;
	}
}