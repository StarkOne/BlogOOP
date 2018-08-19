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
}
