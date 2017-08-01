<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:23 AM
 */
class Input
{
    public static function exists ($type = 'post')
    {
        switch ($type)
        {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_POST)) ? true : false;
                break;

            default:
                return false;
                break;
        }
    }

    public static function get ($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
}