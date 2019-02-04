<?php

namespace Tests\Unit;

// order of includes is important
include 'app/Supports/CryptoAddress/Parser.php';
include 'app/Supports/CryptoAddress/BTCParser.php';
include 'app/Supports/CryptoAddress/Struct.php';
include 'app/Supports/CryptoAddress/ValidationFactory.php';
include 'app/Supports/CryptoAddress/BaseValidator.php';
include 'app/Supports/CryptoAddress/DefaultValidator.php';
include 'app/Supports/CryptoAddress/XRPValidator.php';

use PHPUnit\Framework\TestCase;
use App\Supports\CryptoAddress\Parser;
use App\Supports\CryptoAddress\BTCParser;
use App\Supports\CryptoAddress\ValidationFactory;
use App\Supports\CryptoAddress\BaseValidator;
use App\Supports\CryptoAddress\DefaultValidator;
use App\Supports\CryptoAddress\XRPValidator;

/**
 * A basic unit test for Parser on altcoins addresses
 *
 */
class AltCryptoAddressParserTest extends TestCase
{
    /**
     * A basic test for DASH addresses in dash.onion file.
     *
     * @return void
     */
    public function testAddressesDASH()
    {
        $source = 'tests/Unit/dash.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        echo "\nDASH count:".$actualCount."\n";
        $this->assertTrue(is_array($result) === true);
        $this->assertTrue($actualCount === 25);
        print_r($result);
    }

    /**
     * A basic test for DOGE addresses in doge.onion file.
     *
     * @return void
     */
    public function testAddressesDOGE()
    {
        $source = 'tests/Unit/doge.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        echo "\nDOGE count:".$actualCount."\n";
        $this->assertTrue(is_array($result) === true);
        //$this->assertTrue($actualCount === 44); // TODO
        $this->assertTrue($actualCount === 46); // 44DOGE+2NEO
        print_r($result);
    }

    /**
     * A basic test for Monero addresses in monero.onion file.
     *
     * @return void
     */
    public function testAddressesXMR()
    {
        $source = 'tests/Unit/monero.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        echo "\nMONERO count:".$actualCount."\n";
        $this->assertTrue(is_array($result) === true);
        $this->assertTrue($actualCount === 1);
        print_r($result);
    }

    /**
     * A basic test for LTC addresses in litecoin.onion file.
     *
     * @return void
     */
    public function testAddressesLTC()
    {
        $source = 'tests/Unit/litecoin.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nLTC count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 69); // assert magic number! 27BTC + 42LTC
    }


    /**
     * A basic test for ETH addresses in eth.onion file.
     *
     * @return void
     */
    public function testAddressesETH()
    {
        $source = 'tests/Unit/eth.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nETC count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 64); // customized word boundary used
    }

    /**
     * A basic test for BCH addresses in bch.onion file.
     *
     * @return void
     */
    public function testAddressesBCH()
    {
        $source = 'tests/Unit/bch.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nBCH count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 3); // customized word boundary used
    }

    /**
     * A basic test for NEO addresses in neo.onion file.
     *
     * @return void
     */
    public function testAddressesNEO()
    {
        $source = 'tests/Unit/neo.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nNEO count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 21);
    }

    /**
     * A basic test for XRP addresses in xrp.onion file.
     *
     * @return void
     */
    public function testAddressesXRP()
    {
        $source = 'tests/Unit/xrp.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nXRP count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 5); // customized word boundary used
    }

    /**
     * A basic test for ZEC addresses in onion file.
     *
     * @return void
     */
    public function testAddressesZEC()
    {
        // zcash input file with t-addr
        $source = 'tests/Unit/zcash_taddr_1.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nZEC T count:".$actualCount."\n";
        print_r($result);
        $this->assertTrue($actualCount === 2);

        // zcash input file with zc legacy address
        $source = 'tests/Unit/zcash_zc_donate.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nZEC ZC count:".$actualCount."\n";
        print_r($result);
        $this->assertTrue($actualCount === 1);

        // zcash input file with 3 types of zcash addresses - zs, zc and t
        $source = 'tests/Unit/zcash_zs_zc_t.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nZEC count:".$actualCount."\n";
        print_r($result);
        $this->assertTrue($actualCount === 3);
    }
}
