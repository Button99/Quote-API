<?php

namespace Src\app;

use Src\app\MySQLConnection;

class QuoteGateway
{
    private $conn;
    public function __construct(MySQLConnection $mySQLConnection) {
        $this->conn= $mySQLConnection->connect();
    }

    public function getAll(): array {
        $sql= "SELECT * FROM quote";
        $statement= $this->conn->query();
        $data= ['empty'];
        while ($row= $statement->fetch(PDO::FETCH_ASSOC)) {
            $data= $row;
        }
        return $data;
    }
}