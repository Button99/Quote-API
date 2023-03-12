<?php

namespace Runner\QuoteApi\app;

use PDO;
use Runner\QuoteApi\database\SqliteConnection;

class QuoteGateway
{
    private $conn;
  
    public function __construct(SqliteConnection $sqliteConnection) {
        $this->conn= $sqliteConnection->connect();
    }

    public function getAll(): array {
        $sql= "SELECT * FROM quotes";
        $statement= $this->conn->query($sql);
        $data= ['empty'];
        while ($row= $statement->fetch(PDO::FETCH_ASSOC)) {
            $data= $row;
        }
        return $data;
    }

    public function create(array $data): string {
        $sql= 'INSERT INTO quotes(name, quote, topic) VALUES (:name, :quote, :topic)';

        $stmt= $this->conn->prepare($sql);
        var_dump($stmt);
        $stmt->bindValue(":name", $data['name']);
        $stmt->bindValue(":quote", $data['quote']);
        $stmt->bindValue(':topic', $data['topic']);

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