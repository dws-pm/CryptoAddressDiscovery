<?php

namespace Tests\Unit;
include 'app/Supports/CryptoAddress/Parser.php';
include 'app/Supports/CryptoAddress/BTCParser.php';
include 'app/Supports/CryptoAddress/Struct.php';

use PHPUnit\Framework\TestCase;
use App\Supports\CryptoAddress\Parser;
use App\Supports\CryptoAddress\BTCParser;

/**
 * A basic unit test for Parser on BTC addresses.
 *
 */
class CryptoAddressParserTest extends TestCase
{
    /**
     * A basic test for valid BTC addresses in bacon.onion file.
     *
     * @return void
     */
    public function testGoodAddressesBTC()
    {
        $source = 'tests/Unit/bacon.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        echo 'Results count:'.$actualCount."\n";
        $this->assertTrue(is_array($result) === true && $actualCount === 10); // 10 valid entries
        print_r($result);
    }

    /**
     * A basic test for bad BTC address in bad.onion file.
     * bad.onion is the same as bacon.onion except that it has 1 invalid address.
     *
     * @return void
     */
    public function testBadAddressesBTC()
    {
        $source = 'tests/Unit/bad.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        echo 'Results count:'.$actualCount."\n";
        $this->assertTrue(is_array($result) === true && $actualCount === 9); // 9 valid entries, 1 invalid
        print_r($result);
    }
}
