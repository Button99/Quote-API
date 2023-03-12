<?php
namespace Runner\QuoteApi\database;
require './SqliteConnection.php';

$sqlite= new SqliteConnection();
$conn= $sqlite->connect();
try {
  $res= $conn->exec("CREATE TABLE IF NOT EXISTS quotes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    quote TEXT,
    topic TEXT);");

  if($res) {
    print 'Success';
    echo 'success';
  } else {
    echo 'err';
  }
} catch(PDOException $ex) {
  echo $ex->getMessage();
}
?>