<?php


use Database\DB;
use Database\QueryBuilder;


class Model
{
    public $db;
    private $config;

    private $queryBuilder;

    protected $table;

    public function __construct()
    {
        $this->config = require 'config.php';
        $database = new DB($this->config['database']);
        $this->queryBuilder = new QueryBuilder($database);
    }

    public function all(): mixed
    {
        return $this->queryBuilder->getAll($this->table);
    }
    public function findOne($id): mixed
    {
        return $this->queryBuilder->findOne($this->table, $id);
    }
}
