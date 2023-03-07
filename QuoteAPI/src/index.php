<?php
declare(strict_types=1);

require '../vendor/autoload.php';
use Src\app\MySQLConnection;

set_exception_handler('\Src\handlers\ErrorHandler::handleException');

header("Content-type: application/json; charset=UTF-8");

$db= new MySQLConnection('localhost', 'Quote', 'root', '1234');

$gateway= new \Src\app\QuoteGateway($db);
$controller= new \Src\controllers\QuoteController($gateway);
$id= '1';
$controller->processRequest($_SERVER['REQUEST_METHOD'], null);