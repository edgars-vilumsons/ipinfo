<?php

namespace classes;

class Validator
{
    public static function validateIp($string)
    {
        return (filter_var($string, FILTER_VALIDATE_IP) !== false);
    }

    public static function validatePathName($path)
    {
        return (strpbrk($path, "?%*|\"<>") === false);
    }
}