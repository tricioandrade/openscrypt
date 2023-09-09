<?php

namespace OpensCrypt\App\Traits;

trait GenerateKeysTrait
{

    private function generate(array $config, string $privateKeyPath, string $publicKeyPath): bool
    {
        openssl_pkey_export(openssl_pkey_new($config), $privateKey, NULL, $config);
        $publicKey = openssl_pkey_get_details(openssl_pkey_new($config));

        if(file_put_contents($privateKeyPath, $privateKey) && file_put_contents($publicKeyPath, $publicKey['key'])):
            return true;
        endif;
        return false;
    }
}