<?php
declare(strict_types=1);

require '../vendor/autoload.php';

use src\database\MySQLConnection;

set_exception_handler('\Src\handlers\ErrorHandler::handleException');
set_exception_handler('\Src\handlers\ErrorHandler::handleError');


header("Content-type: application/json; charset=UTF-8");

$url= explode('/', $_SERVER['REQUEST_URI']);
$id= $url[3] ?? null;

$db= new MySQLConnection('localhost', 'QuoteDB', 'root', '');

$gateway= new \Src\app\QuoteGateway($db);
$controller= new \Src\controllers\QuoteController($gateway);
$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);