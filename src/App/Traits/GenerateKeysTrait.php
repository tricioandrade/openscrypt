<?php

namespace OpensCrypt\App\Traits;

use ErrorException;
use OpensCrypt\App\Enum\Encrypt\FilesPathEnum;

trait GenerateKeysTrait
{
    public string $privateKeyFileName   = '\\private.pem';
    public string $publicKeyFileName    = '\\public.pem';

    private string $privateKeyFile;
    private string $publicKeyFile;
    private string $keysDir;

    private object $keys;

    /**
     * Verify if .pem file keys are created
     *
     * @return bool
     */
    public function isPem(): bool
    {
        return  is_file($this->keysDir . $this->privateKeyFileName) &&
                is_file($this->keysDir .$this->publicKeyFileName);
    }

    /**
     * Get generated keys
     *
     * @return object
     */
    public function getKeys(): object
    {
        return $this->keys;
    }

    /**
     * Get keys dir path
     *
     * @return object
     */
    public function getKeysPath(): object
    {
        return (object)[
            'public_key'    => $this->publicKeyFile,
            'private_key'   => $this->privateKeyFile
        ];
    }

    /**
     * Generate private and public
     * keys for encryption
     *
     * @param array $config
     * @param string $dir
     * @throws ErrorException
     */
    private function generateKeys(array $config, string $dir)
    {
        $privateKeyResource = openssl_pkey_new($config);

        openssl_pkey_export($privateKeyResource, $privateKey, NULL, $config);
        $publicKey = openssl_pkey_get_details($privateKeyResource);

        $this->keysDir = $this->checkKeysDirectory($dir);

        print_r($this->keysDir);

        if(!(
            file_put_contents($this->keysDir . $this->privateKeyFileName, $privateKey) &&
            file_put_contents($this->keysDir . $this->publicKeyFileName, $publicKey['key'])
        )):

            $this->keys = (object)[
                'public_key'    => $publicKey['key'],
                'private_key'   => $privateKey
            ];

        else:

            $this->publicKeyFile    = $this->keysDir .$this->publicKeyFileName;
            $this->privateKeyFile   = $this->keysDir . $this->privateKeyFileName;

        endif;
    }

    /**
     * Check if given directory exists
     * if not create, if not given
     * create the default dir.
     *
     * @param string $dir
     * @return string
     * @throws ErrorException
     */
    private function checkKeysDirectory(string $dir): string
    {
        $defaultDir = __DIR__. '\\' .FilesPathEnum::DEFAULT_KEY_PATH->value;

        if (is_dir($dir) || mkdir($dir, 777, true)) {
            return $dir;
        }else {
            if(is_dir($defaultDir) || mkdir($defaultDir, 777, true))
                return $defaultDir;
        }

        throw new ErrorException('Folder creation error');
    }
}