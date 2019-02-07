<?php

namespace App\Supports\CryptoAddress;

/**
 * A default no-op crypto address validation.
 *
 * @author Sebastian Ma <sebmalikkeung@gmail.com>
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
