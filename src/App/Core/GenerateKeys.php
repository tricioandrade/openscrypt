<?php

namespace OpensCrypt\App\Core;

use OpensCrypt\App\Traits\GenerateKeysTrait;

class GenerateKeys
{
    use GenerateKeysTrait;

    /**
     * Set config parameters
     *
     * @param array $config
     * @param string $privateFileDir
     * @param string $publicFileDir
     */
    public function __construct(
        public array $config = [
            'config'            => __DIR__ . '../../../bin/php/extras/openssl/openssl.cnf',
            'private_key_bits'  => 1024,
            'digest_alg'        => 'sh1'
        ],
        public string $privateFileDir = __DIR__ . '\\private.pem',
        public string $publicFileDir  = __DIR__ . '\\public.pem'

    ){ return $this;}

    /**
     * Generate hash and return bool
     *
     * @return bool
     */
    public function get(): bool
    {
        return $this->generate($this->config, $this->privateFileDir, $this->publicFileDir);
    }
}