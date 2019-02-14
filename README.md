# CryptoAddressDiscovery
This repository contains PHP implementation for parsing and extracting crypto-currency addresses.

For example, we can simply execute Parser->extractAddresses() function by passing in a html or text file.
``php
        $source = 'bitcoins_for_sale.html';
        $this->assertTrue(file_exists($source), 'The file '.$source.' does not exists!');
        $content = file_get_contents($source);

        // instantiate our parser and extract the crypto addresses
        $parser = new Parser(); 
        $result = $parser->extractAddresses($source, $content);
        
        // assert we extracted 10 addresses
        $this->assertFalse(is_null($result));
        $actualCount = count($result);
        $this->assertTrue(is_array($result) === true && $actualCount === 10);
```

## Pre-requisites
UBUNTU 16.04<br/>
PHP 7.1.26<br/>
PHPUNIT 7.4.5<br/>

## Application classes
The app directory contains the PHP classes that can be used in your PHP applications.

For usage examples, please refer to the Unit Tests.


## Configuration class(es)
The config directory contains the regular expressions for parsing crypto-currency addresses.


## Unit Tests
Execute phpunit from this repository's root directory. For example:

```sh
~/github/dws-pm/CryptoAddressDiscovery$ phpunit Unit tests/Unit/CryptoConfigTest.php

~/github/dws-pm/CryptoAddressDiscovery$ phpunit Unit tests/Unit/CryptoAddressParserTest.php

~/github/dws-pm/CryptoAddressDiscovery$ phpunit Unit tests/Unit/AltCryptoAddressParserTest.php

~/github/dws-pm/CryptoAddressDiscovery$ phpunit Unit tests/Unit/AltCryptoAddressParserNegativeTest.php

```



