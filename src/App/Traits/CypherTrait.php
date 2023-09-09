<?php

namespace OpensCrypt\App\Traits;

use Exception;
use OpensCrypt\App\Enum\Encrypt\EncryptionTypesEnum;
use OpenSSLAsymmetricKey;

trait CypherTrait
{
    public string $key;
    public string $hash;

    /**
     * Encrypt the given string target
     *
     * @param string $target
     * @param int $cypher
     * @param bool $base64
     * @param int $paddingAlgo
     * @return string
     * @throws Exception
     */
    public function encrypt(
        string $target,
        int $cypher, 
        bool $base64,
        int $paddingAlgo 
    ): string
    {
        if (empty($key)) throw new Exception('You must set the encryption key!');

        $this->key = $this->loadKeyFromFile($cypher) ?? $this->key;
        try {

            switch ($cypher){
                case EncryptionTypesEnum::PRIVATE_KEY_ENCRYPTION->value:
                    openssl_private_encrypt($target, $encryptedTarget, $this->key, $paddingAlgo);
                    $this->hash = $encryptedTarget;
                    break;

                case EncryptionTypesEnum::PUBLIC_KEY_ENCRYPTION->value:
                    openssl_public_encrypt($target, $encryptedTarget, $this->key, $paddingAlgo);
                    $this->hash = $encryptedTarget;
                    break;

                case EncryptionTypesEnum::OPEN_SSL_SIGN->value:
                    openssl_sign($target, $encryptedTarget, $this->key,  OPENSSL_ALGO_SHA1);
                    $this->hash = $encryptedTarget;
                    break;
            };

            return $base64 ? $this->toBase64($this->hash) : $this->hash;
        }catch (\Throwable $exception){
            throw new Exception('Encryption error! '. $exception->getMessage());
        }

    }

    /**
     * Convert generated hash to base64 cypher
     *
     * @param string $target
     * @return string
     */
    private function toBase64(string $target): string
    {
        return base64_encode($target);
    }

    /**
     * Verify if the given key came from file
     *
     * @param $cypher
     * @return OpenSSLAsymmetricKey|bool|null
     */
    private function loadKeyFromFile($cypher): OpenSSLAsymmetricKey|bool|null
    {
        if (is_file($this->key))
            return match ($cypher){
                EncryptionTypesEnum::PRIVATE_KEY_ENCRYPTION->value,
                EncryptionTypesEnum::OPEN_SSL_SIGN->value => openssl_pkey_get_private(file_get_contents($this->key)),
                EncryptionTypesEnum::PUBLIC_KEY_ENCRYPTION->value   => openssl_pkey_get_public(file_get_contents($this->key))
            };

        return null;
    }
}