<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:23 AM
 */
class Token
{
    public static function generate ()
    {
        $random_value = bin2hex(random_bytes(32));
        return Session::set(Config::get('session/token_name'), $random_value);
    }

    public static function check ($token)
    {
        $tokenName = Config::get('session/token_name');
        $issetToken = Input::get('toke');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }


}