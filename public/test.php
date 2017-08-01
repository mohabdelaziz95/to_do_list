<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/13/17
 * Time: 5:35 PM
 */

try {
    function query ($sql, $params = []) {
        $pre = new PDO('mysql:host=127.0.0.1;dbname=todo', 'root', '');
        $sth = $pre->prepare($sql);
        foreach ($params as $param => $value) {
            $sth->bindValue($param, $value);
        }
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        if ($sth->rowCount()) {
            //echo "result: " . $result->username;
        }
    }
    query("DELETE FROM users WHERE username = :username", ['username' => 'mohamed']);
} catch (PDOException $e) {
    $e->getMessage();
}



$array = [
    'param1'    =>  'value1',
    'param2'    =>  'value2',
    'param3'    =>  'value3'
];

$keys = array_keys($array);
$values = array_values($array);

echo 'Array Keys: <pre>';
print_r($keys);
echo '</pre><hr>';

echo 'Array Values<pre>';
print_r($values);
echo '</pre>';

echo "<hr>";

echo implode(', ', $array);

echo "<hr>";

echo implode('<br> :', $keys);

echo "<hr>";

echo $last_value = end($array);
echo "<br>";
echo str_replace($last_value, ',', '');



foreach ($array as $item) {
    $items = "{$item}, ";
    echo substr_replace($items, "",-1);
}






/**
class DB
{
    private static $_instance = null;

    private $_pdo       = null,
        $_query     = false,
        $_error     =  false,
        $_results    =  null,
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
                return $this->_query = true;
            }
        }
        return $this;
    }

    // action($action * FROM $table WHERE {$where} = [$field, $operator, $param])

    private function action ($action, $table, $where = [], $value)
    {
        if (count($where) == 3) {
            $operators = ['=', '<', '>', '<=', '>='];
            $field      = $where[0];
            $operator   = $where[1];
            $param      = $where[2];


            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} :{$param}";
                if (!$this->query($sql, [$param => $value])->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    // get("users", ['username', '=', 'username'], 'mohamed');

    public function get ($table, $where, $value)
    {
        return $this->action("SELECT * ", $table, $where, $value);
    }

    public function delete ($table, $where, $value)
    {
        return $this->action('DELETE ', $table, $where, $value);
    }

    public function error ()
    {
        return $this->_error;
    }

}

**/

echo strlen('4d5d2f1e63e37234fdc7b4574b51cd1a766b63182d3f50641b048d8000316264ce2cf1875f4c66326ff3091bf4d6856c200551f9b1ab0047eba23417ec5d9135') . "<br>";
$random_value = bin2hex(random_bytes(32));

$message = "hello world";
$token = hash('sha256', $message . $random_value);

echo strlen($message) . ": {$message}<br>";
echo strlen($random_value) . ": " . $random_value . "<br>";
echo strlen($token) . ": " . $token . '<br>';

echo __DIR__;













