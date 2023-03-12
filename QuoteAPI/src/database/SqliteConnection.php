<?php

namespace Runner\QuoteApi\database;
use PDO;
use Runner\QuoteApi\app\Config;

class SqliteConnection {
  private $pdo;

  public function __construct() {
    
  }
  
  public function connect(): PDO {
    try {
      if($this->pdo == null) {
        $dsn= 'sqlite:' . './src/database/database.sqlite';
        $this->pdo= new PDO($dsn);
      }
      return $this->pdo;
    } catch(PDOException $ex) {
        echo $ex;
    }
  }
}