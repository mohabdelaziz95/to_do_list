<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:22 AM
 */
require_once '../private/core/init.php';

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
} else {
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
                    ]
                ]);

                if ($validation->passed()) {
                    try {
                        $user->update([
                            'fullname' => htmlspecialchars(Input::get('Fullname')),
                            'username' => htmlspecialchars(Input::get('Username'))
                        ]);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                    echo 'Your Profile, has been updated successfully';
                } else {
                    foreach ($validation->errors() as $error) {
                        echo $error . "<br>";
                    }
                }
            }
        }
    } else {
        exit;
    }
}
?>

