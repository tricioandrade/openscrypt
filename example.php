<?php

require 'vendor/autoload.php';

$enc = new Tricioandrade\OpensCrypt\opensRSA();

/*
 * First configure encrypt args
 * Start by setting the openssl cnf
 * On Windows Xampp Openssl Config file
 * */
$enc::setConfigFile('c:/xampp/php/extras/openssl/openssl.cnf');
$enc::setDigestAlg(1024);
$enc::se


