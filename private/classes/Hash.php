<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:23 AM
 */
class Hash
{
    public static function createHash ($string, $salt = '')
    {
        return hash('sha256', $string . $salt);
    }

    public static function salt ($length)
    {
        return bin2hex(random_bytes($length));
    }
}