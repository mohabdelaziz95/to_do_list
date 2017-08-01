<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:28 AM
 */

function escape ($string) {
    return htmlspecialchars($string, 'ENT_QUOTES', 'UTF-8');
}

function sanitizeJSON ($value) {
    return json_encode($value);
}

function sanitizeURL ($string) {
    return urlencode($string);
}





