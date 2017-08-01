<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:17 AM
 */

require_once '../private/core/init.php';
$user = new User();
$user->logout();

try {
    DB::getInstance()->delete('users_session', ['user_id', '=', 'user_id'], $user->data()->id);
} catch (Exception $e) {

}
Redirect::to('index.php');