<?php

namespace App\Supports\CryptoAddress;

/**
 * A default no-op crypto address validation.
 */
class DefaultValidator extends BaseValidator
{
    /**
     * This function always return true.
     *
     * @return bool
     */
    public function validate($address){
        return true;
     }

}
