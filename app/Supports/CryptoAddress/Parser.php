<?php

namespace App\Supports\CryptoAddress;

/**
 * This is the main parser for crypto addresses.
 *
 * @author Sebastian Ma <sebmalikkeung@gmail.com>
 */
class Parser
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
        $results = array();

        // First parse BTC
        $parser = new BTCParser();
        $results = $parser->extractAddresses($url, $urlContent);
        // Second parse for other altcoins, any results would be appended
        $this->extractAltAddressesParse($url, $urlContent, $results);

        return $results;
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
     * This function extracts other altcoin addresses and append them to $results.
     * Performance is O(N) where N == count of config.regexes, each call pattern-matches the regex in a loop.
     */
    private function extractAltAddressesParse($url, $urlContent, &$results)
    {
        $regexes = self::getCryptoRegexes();

        // iterating crypto types and corresponding regex, exclude BTC
        foreach ($regexes as $key => $value) {
            $cryptoType = strtoupper($key);
            $pattern = "/".$value."/";
            if ($cryptoType === "BTC") {
                continue;
            }

            if (preg_match_all($pattern, $urlContent, $matches_out)) {
                $matchedItems = array();

                $matchedItems = array_count_values($matches_out[$cryptoType]);
                if (count($matchedItems) > 0) {
                    $this->appendCryptoAddresses($url, $cryptoType, $matchedItems, $results);
                }
            }
        }
    }

    private function getCombinedAltcoinPattern()
    {
        $regexes = self::getCryptoRegexes();

        // iterating crypto types and corresponding regex, exclude BTC
        $total = count($regexes);
        $count = 0;
        $pattern = "/";
        foreach ($regexes as $key => $value) {
            $count++;
            $cryptoType = strtoupper($key);
            if ($cryptoType === "BTC") {
                continue;
            }

            $pattern .= $value."|";

            if ($count != $total) {
                $pattern .= "|";
            }
        }
        $pattern .= "/";
        return $pattern;
    }

    private function appendCryptoAddresses($url, $cryptoType, $newItems, &$results)
    {
        foreach ($newItems as $key => $value) {
            if (!empty($key)) {
                $validator = ValidationFactory::create($cryptoType);
                if ($validator->validate($key)) {
                    $obj = new Struct();
                    $obj->address = $key;
                    $obj->occurrences = $value;
                    $obj->cryptoType = $cryptoType;
                    $obj->sourceUrl = $url;
                    $results[] = $obj;
                }
            }
        }
    }

}
