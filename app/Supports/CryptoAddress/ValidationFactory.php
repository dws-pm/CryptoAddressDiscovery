<?php

namespace App\Supports\CryptoAddress;

/**
 * A Factory class to create crypto address validators.
 *
 * @author Sebastian Ma <sebmalikkeung@gmail.com>
 */
class ValidationFactory
{
    public static function create($type, array $options = array()) {
        $cryptoType = strtoupper($type);
        $validator = new DefaultValidator();

        switch ($cryptoType) {
            case "BCH":
                return new BCHValidator();
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
