<?php

namespace Src\app;

use Src\app\Config;
class SqLiteConnection
{


    /**
     * @var type
     */
    private $pdo;

    public function connect() {
        try {
            $this->pdo= new \PDO('sqlite', Config::PATH_TO_DB);
        } catch (\PDOException $e) {
            return $e;
        }
    }
}