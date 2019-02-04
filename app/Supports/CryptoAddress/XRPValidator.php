<?php

namespace App\Supports\CryptoAddress;

/**
 * XRP crypto address validation.
 */
class XRPValidator extends BaseValidator
{
    /**
     * This function validates the input address is conforming to checksum.
     *
     * @return bool
     */
    public function validate($address){
        $decoded = $this->decodeBase58("rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz", $address);
        if (empty($decoded)) {
            return false;
        }

        $d1 = hash("sha256", substr($decoded,0,21), true);
        $d2 = hash("sha256", $d1, true);

        if(substr_compare($decoded, $d2, 21, 4)) {
            return false;
        }
        return true;
     }

}
