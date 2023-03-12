<?php 
declare(strict_types=1);

require './vendor/autoload.php';
// require './src/database/SqliteConnection.php';
use  Runner\QuoteApi\database\SqliteConnection;
use Runner\QuoteApi\app\QuoteGateway;
use Runner\QuoteApi\controllers\QuoteController;

set_exception_handler('Runner\QuoteApi\handlers\ErrorHandler::handleException');
// set_exception_handler('Runner\QuoteApi\handlers\ErrorHandler::handleError');

header("Content-type: application/json; charset=UTF-8");

$url= $_SERVER['REQUEST_URI'][2];
$db= new SqliteConnection();
$id= $_SERVER['REQUEST_URI'][2] ?? null;
echo $id;
$gateway= new QuoteGateway($db);
$controller= new QuoteController($gateway);
$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
?>