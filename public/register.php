<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:17 AM
 */

require_once '../private/core/init.php';

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}


if (is_ajax_request()) {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [

                'Username' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ],

                'Fullname' => [
                    'required' => true,
                    'min' => 6,
                    'max' => 50,
                ],

                'Password' => [
                    'required' => true,
                    'min' => 6
                ],

                'ConfirmPassword' => [
                    'required' => true,
                    'matches' => 'Password'
                ]
            ]);

            if ($validation->passed()) {
                $user = new User();
                $username = Input::get('Username');
                $fullname = Input::get('Fullname');
                $salt = Hash::salt(32);
                $password = Hash::createHash(Input::get('Password'), $salt);
                $DateTime = new DateTime('now');
                $joined = $DateTime->format('Y-m-d H:i:s');
                try {
                    $user->createUser('users', [
                        'username' => htmlspecialchars($username),
                        'fullname' => htmlspecialchars($fullname),
                        'salt' => $salt,
                        'password' => htmlspecialchars($password),
                        'joined' => $joined
                    ]);

                } catch (Exception $e) {
                    $e->getMessage();
                }
            } else {
                $errors = $validation->errors();
                foreach ($errors as $error) {
                    echo "{$error} <br>";;
                }
            }
        }
    }
}else {
    exit;
}