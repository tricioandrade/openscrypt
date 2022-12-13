<?php
include '../vendor/autoload.php';

$enc = new \Tricioandrade\OpensCrypt\opensRSA();

/*
 * First configure encrypt args
 * Start by setting the openssl cnf
 * On Windows Xampp Openssl Config file
 * */
$enc::setConfigFile('../src/php/extras/openssl/openssl.cnf');

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

$enc::generateKeys();

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














