# OpensCrypt (openscrypt)

<p>OpensCrypt is a package that aims to integrate scripts <i>Classes or Objects, methods</i> that will use PHP's cryptographic functions to encrypt data.</p>

The current version [1.1.0](https://packagist.org/packages/tricioandrade/openscrypt), in the class uses the Openssl php library to generate keys for asymmetric encryption using generated keys.

## Installation
<p>Open the terminal and run:</p>

```
composer require tricioandrade/openscrypt
```

## How to use
You can download the example script using [OpensRSA](http://github.com/tricioandrade/openscrypt) Class. Or just follow the same example below.

```php
<?php
include '../vendor/autoload.php';

$enc = new \Tricioandrade\OpensCrypt\opensRSA();

/*
 * First configure encrypt args
 * Start by setting the openssl cnf
 * On Windows Xampp Openssl Config file
 * */
$enc::setConfigFile('c:/xampp/php/extras/openssl/openssl.cnf');

/*
 * Goto php docs and search for more digest algo
 * On this example i'm using the SH1 or SH-1
 * */
$enc::setDigestAlg('sh1');

/*
 * Set the Private key bits
 * */
$enc::setPrivateKeyBits(1024);

/*
 * Now set where you wanna save the keys
 * */
$privKey = './keys/private.key';
$pubKey = './keys/public.key';

$enc::setPrivateKeyFilePathAndName($privKey);
$enc::setPublicKeyFilePathAndName($pubKey);

/*
 * Generate The Keys
 *
 * Uncomment to get new key Pairs
 * */

//$enc::generateKeys();

/*
 * Encrypt a message
 * Use generateHashWithPrivateKey() to encrypt with Private Key
 * Or use generateHashWithPublicKey() to encrypt with Public Key
 *
 * set false to get the encrypted data without base64 encode
 * */

print_r($enc::generateHashWithPrivateKey('I Will be encrypted', true));

//$enc::generateHashWithPublicKey('I Will be encrypted', false);
```


