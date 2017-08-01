<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:23 AM
 */
class Redirect
{
    public static function to ($location = null)
    {
        if (isset($location)) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        if (!file_exists('includes/errors/404.php')) {
                            include '../../public/includes/errors/404.php';
                        } else {
                            include './includes/errors/404.php';
                        }
                        exit();
                        break;
                }
            }
            header('Location: ' . $location);
        }
    }
}