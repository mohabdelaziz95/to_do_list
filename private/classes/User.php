<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:24 AM
 */
class User
{
    private $_db,
            $_data,
            $_isLoggedIn = false,
            $_sessionName,
            $_cookieName;

    public function __construct ($user = null)
    {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName  = Config::get('remember/cookie_name');

        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function createUser ($table, $fields = [])
    {
        if (!$this->_db->insert($table, $fields)) {
            throw new Exception("there was a problem creating an account.");
        }
    }

    public function update ($fields = [], $id = null)
    {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('users', $fields, $id)) {
            throw new Exception('There was a problem while updating.');
        }
    }

    public function find ($user = null)
    {
        if (isset($user)) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', [$field, '=', $field], $user);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login ($username = null, $password = null, $remember = false)
    {
        if (!$username && !$password && $this->exists()) {
            Session::set($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);
            if ($user) {
                if ($this->data()->password === Hash::createHash($password, $this->data()->salt)) {
                    Session::set($this->_sessionName, $this->data()->id);

                    if ($remember) {
                        $hash = bin2hex(random_bytes(32));
                        $hashCheck = $this->_db->get('users_session', ['user_id', '=', 'user_id'], $this->data()->id);

                        if (!$hashCheck->count()) {
                            $this->_db->insert('users_session',
                                ['user_id' => $this->data()->id,
                                 'hash'    => $hash
                                ]);
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::set($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function data ()
    {
        return $this->_data;
    }

    public function exists ()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function isLoggedIn ()
    {
        return $this->_isLoggedIn;
    }

    public function logout ()
    {
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

}