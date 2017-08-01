<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 6:24 PM
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

                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'todo-text' => ['required' => true]
                ]);

                if ($validation->passed()) {
                    try {
                        $id = $user->data()->id;
                        $todo = htmlspecialchars(Input::get('todo-text'));
                        echo $todo;
                        DB::getInstance()->insert('to_do_lists', [
                            'username' => $user->data()->username,
                            'lists' => $todo,
                            'user_id' => $id,
                            'status' => 0
                        ]);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                }
            }
        }
    } else {
        exit;
    }
}

