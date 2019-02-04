<?php

namespace App\Supports\CryptoAddress;

class ValidationFactory
{
    public static function create($type, array $options = array()) {
        $cryptoType = strtoupper($type);
        $validator = new DefaultValidator();

        switch ($cryptoType) {
            case "XRP":
                return new XRPValidator();
            default:
                return $validator;
        }
        // if your class comes from another namespace
        //$class = 'App\\Supports\\CryptoAddress'.$type;
        //return new $class($options);
        return $validator;
    }
}
