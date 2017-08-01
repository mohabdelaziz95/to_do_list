<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:22 AM
 */
class Cookie
{
    public static function exists ($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function set ($name, $value, $expiry)
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
    }

    public static function get ($name)
    {
        return $_COOKIE[$name];
    }

    public static function delete ($name)
    {
        self::set($name, '', time() - 1);
    }
}