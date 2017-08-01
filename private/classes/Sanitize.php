<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/19/17
 * Time: 6:03 PM
 */
class Sanitize
{
    public static function escape ($string)
    {
        return htmlspecialchars($string, 'ENT_QUOTES', 'UTF-8');
    }

    public static function sanitizeJSON ($value)
    {
        return json_encode($value);
    }

    public static function sanitizeURL ($string)
    {
        return urlencode($string);
    }
}