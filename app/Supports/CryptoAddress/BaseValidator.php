<?php

namespace App\Supports\CryptoAddress;

/**
 * Base class for crypto address validation.
 *
 * @author Sebastian Ma <sebmalikkeung@gmail.com>
 */
class BaseValidator
{
     /**
      * Decodes the input to base58 from a series of valid characters.
      */
     protected function decodeBase58($validChars, $input) {
        $result = "";
        $out = array_fill(0, 25, 0);
        for($i=0;$i<strlen($input);$i++) {
            if(($p=strpos($validChars, $input[$i]))===false){
                return $result;
            }
            $c = $p;
            for ($j = 25; $j--; ) {
                $c += (int)(58 * $out[$j]);
                $out[$j] = (int)($c % 256);
                $c /= 256;
                $c = (int)$c;
            }
            if ($c != 0) {
                return $result;
            }
        }

        $result = "";
        foreach($out as $val){
             $result .= chr($val);
        }

        return $result;
     }
}
