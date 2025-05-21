<?php

class proses
{
    public $con;

    public function __construct()
    {
        $server = 'localhost';
        $user = 'root';
        $psw = '';
        $dbname = 'sim';
        $this->con = new PDO("mysql:host=$server;dbname=$dbname", $user, $psw);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function get($cel = null, $table = null, $property = null)
    {
        $qw = "SELECT $cel FROM $table $property";
        $ret = $this->con->query($qw);
        return $ret;
    }

    public function insert($table, $data = [])
    {
        if (!$table || empty($data)) {
            return false;
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $values = array_values($data);

        $stmt = $this->con->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        if (!$stmt) {
            return false;
        }

        return $stmt->execute($values);
    }

    public function delete($table, $conditions = [])
    {
        if (!$table || empty($conditions)) {
            return false;
        }

        $whereClause = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($conditions)));

        $query = "DELETE FROM $table WHERE $whereClause";

        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }

        return $stmt->execute($conditions);
    }

    public function update($table, $data = [], $condition = '')
    {
        if (!$table || empty($data) || !$condition) {
            return false;
        }

        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));

        $query = "UPDATE $table SET $setClause WHERE $condition";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }

        return $stmt->execute($data);
    }


    public function getNextId($table, $column = null, $prefix = null, $length = null)
    {
        $stmt = $this->con->prepare("SELECT MAX($column) AS maxKode FROM $table");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = $row['maxKode'];

        if ($data === null) {
            return $prefix . str_pad(1, $length, '0', STR_PAD_LEFT);
        } else {
            $nourut = (int) substr($data, strlen($prefix)) + 1;
            return $prefix . str_pad($nourut, $length, '0', STR_PAD_LEFT);
        }
    }
}

$db = new proses();
