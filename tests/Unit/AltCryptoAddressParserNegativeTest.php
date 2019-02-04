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
 * A basic negative tests for Parser.
 *
 * Execute vendor/phpunit/phpunit/phpunit from project root directory
 * NOTE:
 * Whenever you introduce new classes or new namespaces, you may need to run "composer dump-autoload".
 * Otherwise phpunit could throw Class not found error.
 * https://laracasts.com/discuss/channels/testing/testing-a-new-package-class-not-found-error
 */
class AltCryptoAddressParserNegativeTest extends TestCase
{

    /**
     * A negative test for XRP addresses in onion file.
     *
     * @return void
     */
    public function testAddressesXRP1()
    {
        $source = 'tests/Unit/xrp_negative1.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $result = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($result));
        $this->assertTrue(is_array($result) === true);
        $actualCount = count($result);
        echo "\nXRP count:".$actualCount."\n";

        print_r($result);
        $this->assertTrue($actualCount === 0); // customized word boundary used
    }

    /**
     * A negative test for XRP addresses in onion file.
     *
     * @return void
     */
    public function testAddressesXRP2()
    {
        $source = 'tests/Unit/xrp_negative2.onion';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        $parser = new Parser();
        $results = $parser->extractAddresses($source, $content);
        $this->assertFalse(is_null($results));
        $this->assertTrue(is_array($results) === true);

        $typeCount = 0;
        $types = array_column($results, 'cryptoType');
        print_r($types);
        foreach($types as $type) {
            if ($type === 'XRP') {
                $typeCount++;
            }
        }

        echo "\nXRP count:".$typeCount."\n";

        print_r($results);
        $this->assertTrue($typeCount === 0); // customized word boundary used
    }
}
