<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * A basic unit test for testing config file.
 *
 */
class CryptoConfigTest extends TestCase
{
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
     * Iterating the config keys and values.
     *
     * @return void
     */
    public function testIterate()
    {
        $regexes = CryptoConfigTest::getCryptoRegexes();
        $this->assertTrue(count($regexes) > 1);
        $count = 0;
        echo "\n";

        foreach ($regexes as $key => $value) {
            $count++;
            $this->assertFalse(is_null($key));
            $this->assertFalse(is_null($value));

            $cryptoType = strtoupper($key);
            $pattern = "/".$value."/";

            echo $count.' Crypto:'.$cryptoType.' Regex:'.$pattern."\n";
        }
        $this->assertTrue(count($regexes) === $count);
    }

    /**
     * Iterating the config keys and values excluding BTC.
     *
     * @return void
     */
    public function testIterateExcludeBTC()
    {
        $regexes = CryptoConfigTest::getCryptoRegexes();
        $this->assertTrue(count($regexes) > 1);
        $count = 0;
        echo "\n";
        foreach ($regexes as $key => $value) {
            $count++;
            $this->assertFalse(is_null($key));
            $this->assertFalse(is_null($value));

            $cryptoType = strtoupper($key);
            $pattern = "/".$value."/";
            if ($cryptoType === "BTC") {
                continue;
            }
            echo $count.' Crypto:'.$cryptoType.' Regex:'.$pattern."\n";
        }
    }

    /**
     * Iterating the config keys and values excluding BTC.
     *
     * @return void
     */
    public function testGetConfigBTC()
    {
        $regexes = CryptoConfigTest::getCryptoRegexes();
        $this->assertTrue(count($regexes) > 1);
        echo "\n";
        //print_r($regexes);
        $pattern = $regexes["btc"];
        $this->assertFalse($pattern == null);
        echo $pattern;
    }

}
