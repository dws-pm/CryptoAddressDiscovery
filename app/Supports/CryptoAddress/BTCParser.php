<?php

namespace App\Supports\CryptoAddress;

/**
 * This BTC parser uses specific checksum validation.
 */
class BTCParser
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct(); // no parent class
    }

    /**
     * Parses the input string and retuns a list of crypto addresses.
     *
     * @return array of CryptoAddressStuct objects.
     */
    public function extractAddresses($url, $urlContent)
    {
        $result = $this->doExtractToStruct($url, $urlContent);
        return $result;
    }

    /**
     * Static function to read config values from config file.
     *
     * @return array of config objects.
     */
    private static $cryptoRegexes = null;
    protected static function getCryptoRegexes()
    {
        if (self::$cryptoRegexes === null) {
            $configs = include('config/crypto.php');
            self::$cryptoRegexes = $configs->regexes;
        }
        return self::$cryptoRegexes;
    }

    /**
     * This function decodes input string to base58 and returns the decoded string.
     * If error is detected, an empty string is returned.
     *
     * @return string
     */
    protected function decodeBtcBase58($input)
    {
        $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
        $result = "";

        $out = array_fill(0, 25, 0);
        for ($i=0; $i<strlen($input); $i++) {
            if (($p=strpos($alphabet, $input[$i]))===false) {
                return $result;
            }
            $c = $p;
            for ($j = 25; $j--;) {
                $c += (int)(58 * $out[$j]);
                $out[$j] = (int)($c % 256);
                $c /= 256;
                $c = (int)$c;
            }
            if ($c != 0) {
                return $result;
            }
        }

        foreach ($out as $val) {
             $result .= chr($val);
        }

        return $result;
    }

    /**
     * This function validates the input address is conforming BTC checksum.
     *
     * @return bool
     */
    protected function validBtcAddress($address)
    {
        $decoded = $this->decodeBtcBase58($address);
        if (empty($decoded)) {
            return false;
        }

        $d1 = hash("sha256", substr($decoded, 0, 21), true);
        $d2 = hash("sha256", $d1, true);

        if (substr_compare($decoded, $d2, 21, 4)) {
            return false;
        }
        return true;
    }

    private function doExtractToStruct($url, $urlContent)
    {
        $regexes = self::getCryptoRegexes();

        // get the pattern from config/crypto.php
        $pattern = $regexes["btc"];

        $matchedItems = array();
        if (preg_match_all($pattern, $urlContent, $matches_out)) {
            $matchedItems = array_count_values($matches_out[0]);
        }

        $result = array();
        foreach ($matchedItems as $key => $value) {
            if ($this->validBtcAddress($key)) {
                $obj = new Struct();
                $obj->address = $key;
                $obj->occurrences = $value;
                $obj->cryptoType = 'BTC';
                $obj->sourceUrl = $url;
                $result[] = $obj;
            }
        }

        return $result;
    }

}
