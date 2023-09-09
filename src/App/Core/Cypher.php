<?php

namespace OpensCrypt\App\Core;

use Exception;
use OpensCrypt\App\Enum\Encrypt\EncryptionTypesEnum;
use OpensCrypt\App\Traits\CypherTrait;

class Cypher
{
    use CypherTrait;

    /**
     * Set the class properties
     * and return itself
     *
     * @param string $target
     * @param EncryptionTypesEnum $encryptionTypesEnum
     * @param bool $base64
     * @param int $paddingAlgo
     */
    public function __construct(
        public string $target,
        public EncryptionTypesEnum $encryptionTypesEnum = EncryptionTypesEnum::OPEN_SSL_SIGN,
        public bool $base64 = true,
        public int $paddingAlgo = OPENSSL_PKCS1_OAEP_PADDING
    ){ return $this; }

    /**
     * Set the given key and
     * return itself
     *
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Encrypt a string
     *
     * @throws Exception
     */
    public function getHash(): string
    {
        return $this->encrypt(
            $this->target,
            $this->encryptionTypesEnum->value,
            $this->base64,
            $this->paddingAlgo
        );
    }
}