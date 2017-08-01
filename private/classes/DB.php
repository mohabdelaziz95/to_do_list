<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:23 AM
 */
class DB
{
    private static $_instance = null;

    private $_pdo       = null,
            $_query     = false,
            $_error     =  false,
            $_results,
            $_count     = 0,
            $options     = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    private function __construct ()
    {
        try {
            if (!isset($this->_pdo)) {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ' ;dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'), $this->options);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance ()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    private function query ($sql, $params = [])
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if (count($params)) {
                foreach ($params as $param => $value) {
                    $this->_query->bindValue($param, $value);
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else {
                return $this->_error = true;
            }
        } else {
            return $this->_query = false;
        }
        return $this;
    }

    public function action ($action, $table, $where = [], $value, $orderBy = null)
    {
        if (count($where) == 3) {
            $operators = ['=', '<', '>', '<=', '>='];
            $field      = $where[0];
            $operator   = $where[1];
            $param      = $where[2];

            if (in_array($operator, $operators)) {
                if (isset($orderBy)) {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} :{$param} {$orderBy}";
                } else {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} :{$param}";
                }
                if (!$this->query($sql, [$param => $value])->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function get ($table, $where, $value, $orderBy = null)
    {
        if (isset($orderBy)) {
            return $this->action("SELECT * ", $table, $where, $value, "ORDER BY $orderBy");
        } else {
            return $this->action("SELECT * ", $table, $where, $value);
        }

    }

    public function delete ($table, $where, $value)
    {
        return $this->action('DELETE ', $table, $where, $value);
    }

    public function insert ($table, $fields = [])
    {
        if (count($fields)) {

            $values = [];
            $fieldsKeys = array_keys($fields);
            foreach ($fieldsKeys as $fieldsKey) {
                $values[$fieldsKey] = ":{$fieldsKey}";
            }

            $sql = "INSERT INTO {$table} (" . implode(', ', $fieldsKeys) . ") VALUES (" .implode(', ',$values) .")";
            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }

    public function update ($table, $fields = [], $id)
    {
        if (count($fields)) {
            $set = '';
            $values = [];
            $fieldsKeys = array_keys($fields);
            $x = 1;
            foreach ($fieldsKeys as $fieldsKey) {
                $values[$fieldsKey] = $fieldsKey;
                $set .= "{$fieldsKey} = :{$fieldsKey}";
                if ($x < count($fieldsKeys)) {
                    $set .= ", ";
                }
                $x++;
            }


            $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }

    public function error ()
    {
        return $this->_error;
    }

    public function count ()
    {
        return $this->_count;
    }

    public function results ()
    {
        return $this->_results;
    }

    public function first ()
    {
        return $this->results()[0];
    }

    public function lastInsertId ($column, $table)
    {
        return $this->_pdo->query("SELECT MAX({$column}) FROM {$table}", PDO::FETCH_OBJ);
    }

}