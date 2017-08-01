<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:17 AM
 */

require_once '../private/core/init.php';

function is_ajax_request () {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
}

if (is_ajax_request()) {

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                'Username' => ['required' => true],
                'Password' => ['required' => true]
            ]);

            if ($validation->passed()) {

                $user = new User();
                try {
                    $remember = (Input::get('checkbox') === 'on') ? true : false;
                    $login = $user->login(Input::get('Username'), Input::get('Password'), $remember);
                    if ($login) {

                    } else {
                        echo "<p>Sorry, Logging in failed.</p>";
                    }
                } catch (Exception $e) {
                    $e->getMessage();
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo "{$error} <br>";
                }
            }
        }
    }
} else {
    exit;
}



















