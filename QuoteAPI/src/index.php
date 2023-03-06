<?php
declare(strict_types=1);

require '../vendor/autoload.php';
use Src\app\SqLiteConnection;

$pdo= (new SqLiteConnection())->connect();
set_exception_handler('\Src\handlers\ErrorHandler::handleException()');
if($pdo !=null) {
    print 'Connected';
} else {
    print "Error";
}


header("Content-type: application/json; charset=UTF-8");
$controller= new \Src\controllers\QuoteController();
$id= '1';
$controller->processRequest($_SERVER['REQUEST_METHOD'], '1');