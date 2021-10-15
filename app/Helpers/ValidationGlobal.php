<?php

namespace App\Helpers;

use App\Exceptions\CustomException;

class ValidationGlobal
{

	 /**
     * @param $params
     * @param $attributes
     * @throws \Exception
     */
	public static function validateRequiredParameters($params, $attributes)
    {
        foreach ($attributes as $attribute) {
            ValidationGlobal::validateError($params, $attribute);
        }
    }

    /**
     * @param $param
     * @throws \CustomException
     */
    public static function validateError($param, $paramName)
    {
        if (!isset($param[$paramName])) {
            throw new CustomException($paramName . ' is required');
        }
    }

    /**
     * @param $email
     * @throws \CustomException
     */
    public static function validateEmail($email)
    {
        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            throw new CustomException($email . ' must be a email');
        };
    }

    /**
     * @param $str
     * @param string $name
     * @throws \CustomException
     */
    public static function validateString($str, $name = '')
    {
        if (!is_string($str)) {
            throw new CustomException($name . ' must be a string');
        }
    }

    /**
     * @param $str
     * @param string $name
     * @throws \CustomException
     */
    public static function validateNumber($str, $name = '')
    {
        if (is_string($str)) {
            throw new CustomException($name . ' must be a number');
        }
    }



}
