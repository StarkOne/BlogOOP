<?php

namespace core;

class DBDriver 
{
  private $pdo;
  const FETCH_ALL = 'all';
  const FETCH_ONE = 'one';

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function select($sql, array $params = [], $fetch = self::FETCH_ALL)
  {
	  $query = $this->pdo->prepare($sql);
    $query->execute($params);
    if($fetch === self::FETCH_ONE) {
      return $query->fetch();
    }
    return $query->fetchAll();
  }
  public function insert($table, array $params)
  {
    $colums = sprintf('(%s)',implode(',', array_keys($params)));
    $masks = sprintf('(:%s)',implode(', :', array_keys($params)));
    $sql = "INSERT INTO $table $colums VALUES $masks";
		$query = $this->pdo->prepare($sql);
		$query->execute($params);
		//$this->cheakError($query);
    $res = $this->pdo->lastInsertId();
    return $res;
  }
  public function update($table, $params, $where)
  {

  }

  public function delete($table, $where)
  {

  }
}
