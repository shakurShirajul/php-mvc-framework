<?php

namespace Database;

class QueryBuilder
{
    private $dbConnection;
    public function __construct(DB $databaseConnection)
    {
        $this->dbConnection = $databaseConnection;
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM  {$table}";
        return $this->dbConnection->query($sql)->get();
    }
    public function findOne($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return $this->dbConnection->query($sql, ["id" => $id])->find();
    }
}
