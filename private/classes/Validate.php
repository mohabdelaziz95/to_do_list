<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 2:24 AM
 */
class Validate
{
    private $_passed    =   false,
            $_errors     =   [],
            $_db        =   null;

    public function __construct ()
    {
        if (!isset($this->_db)) {
            $this->_db = DB::getInstance();
        }
    }

    public function check ($source = null, $fields = [])
    {
        if (isset($source)) {
            foreach ($fields as $field => $rules) {
                foreach ($rules as $rule => $rule_value) {

                    $value = trim($source[$field]);
                    if ($rule === 'required' && empty($value)) {
                        $this->addError("{$field} is a required filled");
                    } elseif (!empty($value)) {
                        switch ($rule) {
                            case 'min' :
                                if (strlen($value) < $rule_value) {
                                    $this->addError("{$field} must be at least {$rule_value} characters");
                                }
                                break;
                            case 'max' :
                                if (strlen($value) > $rule_value) {
                                    $this->addError("{$field} must Must not exceed {$rule_value} characters");
                                }
                                break;
                            case 'unique' :
                                $check = $this->_db->get($rule_value, [$field, '=', $field], $value);
                                if ($check->count()) {
                                    $this->addError("{$field} is already exist");
                                }
                                break;
                            case 'matches' :
                                if ($value != $source[$rule_value]) {
                                    $this->addError("{$rule_value} does not match {$field}");
                                }
                                break;
                            default :
                                break;
                        }
                    }
                }
            }
            if (empty($this->_errors)) {
                $this->_passed = true;
            }
        }
        return $this;
    }

    private function addError ($error)
    {
        $this->_errors[] = $error;
    }

    public function errors ()
    {
        return $this->_errors;
    }

    public function passed ()
    {
        return $this->_passed;
    }


}