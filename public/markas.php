<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/30/17
 * Time: 10:13 AM
 */


require_once '../private/core/init.php';
function is_ajax_request () {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}



$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
} elseif ($user->isLoggedIn()) {
    try {
        $db = DB::getInstance();
        $as = $_GET['as'];
        $statsId = Input::get('id');

        if (isset($as) && isset($statsId)) {
            switch ($as) {
                case 'done':
                    $db->update('to_do_lists', [
                        'status' => 0],
                        $statsId);
                    break;

                case 'notdone':
                    $db->update('to_do_lists', [
                        'status' => 1],
                        $statsId);
                    break;
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }
    Redirect::to('home.php');
}