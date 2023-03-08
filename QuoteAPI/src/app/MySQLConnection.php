<?php

namespace Src\app;
use PDO;

class MySQLConnection
{
    public function __construct(protected string $host, protected string $name, protected string $user,
        protected string $password) {}

    public function connect(): PDO {
        $dsn= "mysql:host={$this->host}:3306;dbname={$this->name};charset=utf8";

        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_EMULATE_PREPARES =>false,
            PDO::ATTR_STRINGIFY_FETCHES =>false
        ]);
    }
}