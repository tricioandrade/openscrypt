<?php

namespace OpensCrypt\App\Core;

use ErrorException;
use OpensCrypt\App\Traits\GenerateKeysTrait;

class GenerateKeys
{
    use GenerateKeysTrait;

    /**
     * Set encryption config parameters
     *
     * @param string $dir
     * @param array $config
     */
    public function __construct(
        public string $dir =  '',
        public array $config = [
            'config'            => __DIR__ . '../../../../bin/php/extras/openssl/openssl.cnf',
            'private_key_bits'  => 1024,
            'digest_alg'        => 'sh1'
        ]
    ){ return $this;}

    /**
     * Generate keys
     *
     * @return GenerateKeys
     * @throws ErrorException
     */
    public function generate(): self
    {
        $this->generateKeys($this->config, $this->dir);
        $this->setKeysDir();
        return $this;
    }

    /**
     * Set the keys dir
     */
    private function setKeysDir()
    {
        $this->dir = $this->keysDir;
    }
}