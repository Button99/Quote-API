<?php

namespace Src\app;
use PDO;

class MySQLConnection
{
    public function __construct(protected string $host, protected string $name, protected string $user,
        protected string $password) {}

    public function connect(): PDO {
        $dsn= "msql:host={$this->host};dbname={$this->name};charset=utf8";

        return new PDO($dsn, $this->user, $this->password);
    }
}