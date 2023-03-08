<?php

namespace Src\app;

use Src\app\MySQLConnection;
use PDO;

class QuoteGateway
{
    private $conn;
    public function __construct(MySQLConnection $mySQLConnection) {
        $this->conn= $mySQLConnection->connect();
    }

    public function getAll(): array {
        $sql= "SELECT * FROM Quote";
        $statement= $this->conn->query($sql);
        $data= ['empty'];
        while ($row= $statement->fetch(PDO::FETCH_ASSOC)) {
            $row['is_available']= (bool) $row['is_available'];
            $data= $row;
        }
        return $data;
    }

    public function create(array $data): string {
        $sql= "INSERT INTO Quote(name, quote, created_at) VALUES (:name, :quote, :created_at)";

        $stmt= $this->conn->prepare($sql);
        $stmt->bindValue(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(":quote", $data['quote'], PDO::PARAM_STR);

        $stmt->bindValue(":created_at", date('y-m-d', (int)getdate()), PDO::PARAM_STR);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function get(string $id) {
        $sql= "SELECT * FROM Quote WHERE id= :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data= $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update(array $curr, array $new): int {
        $sql="UPDATE Quote SET name= :name,
                 quote= :quote, created_at = :created_at
                 WHERE id= :id";

        $stmt= $this->conn->prepare($sql);
        $stmt->bindValue(':name', $new['name'] ?? $curr['name'], PDO::PARAM_STR);
        $stmt->bindValue(':quote', $new['quote'] ?? $curr['quote'], PDO::PARAM_STR);
        $stmt->bindValue(':created_at', $new['created_at'] ?? $curr['created_at'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $curr['id'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int {
        $sql= "DELETE FROM Quote WHERE id= :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}