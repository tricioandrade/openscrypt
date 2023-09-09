# OpenScrypt

[![Latest Stable Version](http://poser.pugx.org/tricioandrade/openscrypt/v)](https://packagist.org/packages/tricioandrade/openscrypt) [![Total Downloads](http://poser.pugx.org/tricioandrade/openscrypt/downloads)](https://packagist.org/packages/tricioandrade/openscrypt) [![License](http://poser.pugx.org/tricioandrade/openscrypt/license)](https://packagist.org/packages/tricioandrade/openscrypt) [![PHP Version Require](http://poser.pugx.org/tricioandrade/openscrypt/require/php)](https://packagist.org/packages/tricioandrade/openscrypt)

<p>OpensCrypt is a package that aims to integrate scripts <i>Classes or Objects, methods</i> that will use PHP's cryptographic functions to encrypt data.</p>

The class uses the Openssl php library to generate key pairs for asymmetric encryption.

## Installation

```
composer require tricioandrade/openscrypt
```

### How to use generate keys

```php
<?php
    $instance = new GenerateKeys();
    $instance->generate();
    
    // Print or save your keys anywere 
    $instance->getKeys();
```

<p>Change where you want save your keys</p>

```php
    $instance = new GenerateKeys(__DIR__ . '\\');
```

<p>Get complete keys path or the generated keys:</p>

```php
    $instance = new GenerateKeys(__DIR__ . '\\');
    $instance->generate();
    
    if ($instance->isPem()){
        print_r($instance->getKeysPath());
    }
    else{
        print_r($instance->getKeys());
    }
```

<p>Change files name:</p>

```php
    $instance->privateKeyFileName   = 'MyPrivateKey.pem';
    $instance->publicKeyFileName    = 'MyPublicKey.pem';
```

### Starting encryption

```php
    $cypher = new Cypher('Hello');
        
    print_r(
        $cypher->setCypherKey(file_get_contents('./MyPrivateKey.pem'))
        ->getHash()
    );
```