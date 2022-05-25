<?php

require 'vendor/autoload.php';
use Tricioandrade\OpensCrypt\opensRSA;

$enc = new opensRSA();

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
 * Here You Can see the config args that will be used to generate de encrypt keys
 * */
// $enc::getConfigArgs();

/*
 * Now set where you wanna save the keys
 * */
$pivKey = './example-keys/private.key';
$pubKey = './example-keys/public.key';

$enc::setPrivateKeyFilePathAndName($pivKey);
$enc::setPublicKeyFilePathAndName($pubKey);

/*
 * Generate The Keys
 * */
$enc::generateKeys();

#see the PrivKey
var_dump(file_get_contents($pubKey));

#see the PubKey
var_dump(file_get_contents($pubKey));









