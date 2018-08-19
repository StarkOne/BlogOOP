<?php
namespace models;
use core\DBDriver;

class LoginModel extends BaseModel
{
	protected $idTable = 'id_users';
	public function __construct(DBDriver $db)
	{
		parent::__construct($db, 'users');
	}

	public function checkAdmin()
	{
		$sql = "SELECT * FROM $this->table WHERE $this->idTable = 1";
		// $query = $this->db->prepare($sql);
		// $query->execute();
		// $res = $query->fetch();
		return $this->db->select($sql, [], 'one' );
	}
}