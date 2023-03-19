<?php

namespace Classes;

use Config\Database;

class QueryBuilder
{
    public $connection;
    protected $table, $columns = "*", $conditions = "", $order_by = "", $limit;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function table($table)
    {
        $this->table .= " $table";
    }

    public function select($columns = '*')
    {
        $this->columns .= " $columns";
    }

    public function order_by($column, $sort_by = 'DESC')
    {
        $this->columns .= " $column $sort_by";
    }

    public function limit($length, $start = 0)
    {
        $this->limit = " LIMIT $start, $length";
    }

    public function where($key, $operator, $value)
    {
        if (!empty($this->conditions)) $this->conditions .= 'where';
        $this->conditions .= " $key $operator $value";
    }

    public function get($table = null)
    {
        if (!empty($table)) $this->table = $table;
        $query = "SELECT";
        $query .= $this->columns;
        $query .= ' FROM ';
        $query .= $this->table;
        $query .= $this->conditions;
        $query .= $this->order_by;
        $query .= $this->limit;

        try {
            $results = mysqli_query($this->connection, $query);
            if (mysqli_num_rows($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}