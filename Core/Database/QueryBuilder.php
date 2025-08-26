<?php

namespace Database;

class QueryBuilder
{
    private $dbConnection;
    protected $table;
    public function __construct(DB $databaseConnection, $table)
    {
        $this->dbConnection = $databaseConnection;
        $this->table = $table;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM  {$this->table}";
        return $this->dbConnection->query($sql)->get();
    }
    public function findOne($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->dbConnection->query($sql, ["id" => $id])->find();
    }
    public function createOne($data = [])
    {
        try {
            if (empty($data) || !is_array($data)) {
                return [
                    'success' => false,
                    'error' => 'Invalid data provided',
                    'message' => 'Data must be a non-empty array'
                ];
            }

            $fieldString = "";
            $valueString = "";
            $values = [];

            foreach ($data as $field => $value) {
                $fieldString .= "`{$field}`, ";
                $valueString .= ":{$field}, ";
                $values[$field] = $value;
            }

            $fieldString = rtrim($fieldString, ', ');
            $valueString = rtrim($valueString, ', ');
            $sql = "INSERT INTO {$this->table}({$fieldString}) VALUES({$valueString})";

            $result = $this->dbConnection->query($sql, $values);
            return [
                'success' => true,
                'id' => $this->dbConnection->lastInsertId(),
                'message' => 'Record created successfully',
                'sql' => $sql
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'message' => 'Database operation failed'
            ];
        }
    }
    public function updateOne($data = [], $whereId = 5)
    {
        $fieldString = "";
        $values = [];
        foreach ($data as $field => $value) {
            $fieldString .= "`{$field}` = :{$field}, ";
            $values[$field] = $value;
        }
        $fieldString = rtrim($fieldString, ', ');

        $whereString = "";
        $whereString = "WHERE `id` = :where_id";
        $values['where_id'] = $whereId;

        $sql = "UPDATE `{$this->table}` SET {$fieldString} {$whereString}";
        return $this->dbConnection->query($sql, $values);
    }
    public function deleteOne($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE `id` = :id";
        return $this->dbConnection->query($sql, ["id" => $id]);
    }
}
