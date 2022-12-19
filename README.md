# openscrypt

[![Latest Stable Version](http://poser.pugx.org/tricioandrade/openscrypt/v)](https://packagist.org/packages/tricioandrade/openscrypt) [![Total Downloads](http://poser.pugx.org/tricioandrade/openscrypt/downloads)](https://packagist.org/packages/tricioandrade/openscrypt) [![License](http://poser.pugx.org/tricioandrade/openscrypt/license)](https://packagist.org/packages/tricioandrade/openscrypt) [![PHP Version Require](http://poser.pugx.org/tricioandrade/openscrypt/require/php)](https://packagist.org/packages/tricioandrade/openscrypt)

<p>OpensCrypt is a package that aims to integrate scripts <i>Classes or Objects, methods</i> that will use PHP's cryptographic functions to encrypt data.</p>

The class uses the Openssl php library to generate key pairs for asymmetric encryption.

## Installation
<p>Open your terminal and run:</p>

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
$privKey = './private.key';
$pubKey = './public.key';

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
 * Use encrypt() method to encrypt, you must provide params types for encrypt
 *
 * $privateKeyEncrypt
 * $publicKeyEncrypt
 * $opensslSign
 *
 *
 * set false to get the encrypted data without base64 encode
 * */

print_r($enc::encrypt('I Will be encrypted', $enc::$opensslSign));

