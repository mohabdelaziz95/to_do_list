<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:24 AM
 */

session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host'      =>  '127.0.0.1',
        'db'        =>  'todo',
        'username'  =>  'root',
        'password'  =>  ''
    ],
    'remember' => [
        'cookie_name'   =>  'hash',
        'cookie_expiry' =>  604800
    ],
    'session' => [
        'session_name'  =>  'user',
        'token_name'    =>  'token'
    ]
];

error_reporting(E_ALL && ~E_NOTICE);

spl_autoload_register('classes');
function classes ($class) {
    if (file_exists('../private/classes/' . $class . '.php')) {
        require_once '../private/classes/' . $class . '.php';
    }
}

classes('DB');

if (file_exists('../private/functions/sanitize.php')) {
    require_once '../private/functions/sanitize.php';
}
