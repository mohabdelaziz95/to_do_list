<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/26/17
 * Time: 8:39 PM
 */


require_once '../private/core/init.php';
function is_ajax_request () {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}


$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
} elseif ($user->isLoggedIn()) {
    if (is_ajax_request()) {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                try {
                $db = DB::getInstance();
                $listsData = $db->get('to_do_lists', ['username', '=', 'username'], $user->data()->username);
                if ($listsData->count()) {
                    $x = 0;
                    foreach ($listsData->results() as $key => $results) {
                        $x++;
                        foreach ($results as $listKeys => $listValues) {
                            if ($listKeys == 'id') {
                                $listId = $listValues;
                            }
                        }
                    }
                }
                if (isset($listId) && isset($x)) {
                    echo $x;
                    DB::getInstance()->delete('to_do_lists', ['id', '=', 'id'], $listId);
                }

                } catch (Exception $e) {
                    $e->getMessage();
                }
            }
        }
    } else {
        exit;
    }
}