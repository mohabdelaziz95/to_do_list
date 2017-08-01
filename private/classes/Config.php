<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:22 AM
 */
class Config
{
    public static function get($path = null)
    {
        if (isset($path)) {

            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $item) {

                if (isset($config[$item])) {
                    $config = $config[$item];
                } else {
                    return false;
                }
            }
            return $config;
        }
        return false;
    }

}