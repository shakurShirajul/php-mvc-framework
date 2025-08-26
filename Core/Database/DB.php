<?php

namespace Database;

use PDO;

class DB
{
    private $pdo, $statement;
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($sql, $params = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($params);
        return $this;
    }
    public function get()
    {
        return $this->statement->fetchAll();
    }
    public function find()
    {
        return $this->statement->fetch();
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
