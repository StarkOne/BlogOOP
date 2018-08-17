<?php

namespace core;

class DBConnector
{

  private static
      $instance = null;
  /**
   * @return Singleton
   */
  public static function getInstance()
  {
      if (null === self::$instance)
      {
          self::$instance = new self();
      }
      return self::$instance;
  }
  private function __construct() {
  }
  
	public static function getPDO()
	{
		$dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'php3');
		return new \PDO($dsn, 'root', '');
	}
}