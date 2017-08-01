<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/19/17
 * Time: 10:36 AM
 */

require_once '../private/core/init.php';
/**
$user = new User();

$fullname = escape(Input::get('Fullname'));
$salt = Hash::salt(32);
$password = escape(Hash::createHash(Input::get('Username'), $salt));
$DateTime = new DateTime('now');
$joined = $DateTime->format('Y-m-d H:i:s');
try {
    $user->createUser('users', [
        'username' => 'mohamed',
        'fullname' => 'mohamed',
        'salt' => $salt,
        'password' => '123456',
        'joined' => $joined
    ]);

} catch (Exception $e) {
    $e->getMessage();
}**/

/**
function foo ($columns = []) {
    if (count($columns)) {
        /**$columnSet = '';
        $x = 1;
        foreach ($columns as $column) {
            $columnSet .= $column;
            if ($x < $columns) {
                $columnSet .= ', ';
            }
            $x++;
        }
        echo $columnSet;**/
        /**echo implode(', ', $columns);
    }
}

//foo(['id', 'username', 'fullname']);

$array = ['status'];
//echo implode(', ', $array);
**/
$db = new PDO('mysql:host=127.0.0.1;dbname=todo', 'root', '');
/**$sql = 'INSERT INTO to_do_lists (lists) VALUES (:lists)';
$sth = $db->prepare($sql);
$sth->bindValue('lists', 'hi');
$sth->execute();
$results = $sth->fetchAll();

foreach ($results as $resultLists) {
    foreach ($resultLists as $key => $result) {
        if ($key == 'lists') {
            echo $result . '<br>';
        }
    }
}**/
/**$sth = $db->query('SELECT MAX(id) FROM to_do_lists', PDO::FETCH_OBJ);
foreach ($sth as $results) {
    foreach ($results as $result) {
        echo $result;
    }
}**/

//echo $db->lastinsertid();

$db = DB::getInstance();
$lists = $db->get( 'to_do_lists', ['user_id', '=', 'user_id'], 4, 'id DESC');
if ($lists->count()) {
    foreach ($lists->results() as $key => $results) {
        $statusId = $results->id;
    }
}

/**$db->update('to_do_lists', [
    'status'    =>  0
], 129);**/

$db->delete('users_session', ['user_id', '=', 'user_id'],4)

?>
<!--
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form">
    <p id="demo"></p>
    <!--<button onclick="myFunction()" name="input" type="button" value="mohamed" id="done"> click me </button>-->
    <!--<input type="hidden" value="<?php //echo $results->id;?>" name="val">
    <button onclick="markAs()" id="done" type="button" name="status" value="mohamed">Click Me</button>
</form>

<script>

    /**function markAs() {

        var form = document.getElementById("form");
        var mark_as_value = new FormData(form);
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'markas.php', true);
        xhr.setRequestHeader('x-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
            }
        };
        xhr.send(mark_as_value);
    }

    /**function myFunction() {
        var x = document.getElementById('done').value;
        document.getElementById("demo").innerHTML = x;
    }**/
</script>
