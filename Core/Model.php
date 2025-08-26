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
        $this->queryBuilder = new QueryBuilder($database, $this->table);
    }

    public function all(): mixed
    {
        return $this->queryBuilder->getAll();
    }
    public function findOne($id): mixed
    {
        return $this->queryBuilder->findOne($id);
    }
    public function createOne($data): mixed
    {
        try {
            if (empty($data) || !is_array($data)) {
                return [
                    'success' => false,
                    'error' => 'Invalid input data',
                    'message' => 'Data must be a non-empty array'
                ];
            }
            $result = $this->queryBuilder->createOne($data);
            return $result;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'An unexpected error occurred while creating the record'
            ];
        }
    }
    public function updateOne($data)
    {
        return $this->queryBuilder->updateOne($data);
    }
    public function deleteOne($id)
    {
        return $this->queryBuilder->deleteOne($id);
    }
}
