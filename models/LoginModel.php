<?php
namespace models;

class LoginModel extends BaseModel
{
	protected $idTable = 'id_users';
	public function __construct(\PDO $db)
	{
		parent::__construct($db, 'users');
	}

	public function checkAdmin()
	{
		$sql = "SELECT * FROM $this->table WHERE $this->idTable = 1";
		$query = $this->db->prepare($sql);
		$query->execute();
		$res = $query->fetch();
		return $res;
	}
}