<?php


namespace Tricioandrade\OpensCrypt;

class enCrypt
{
    private static $configArgs = array (
        'config' => "c:/xampp/php/extras/openssl/openssl.cnf",
        'private_key_bits' => 1024,
        'digest_alg' => 'sha1'
    );

    private static $digest_alg;
    private static $privateKeyBits;
    private static $configFile;
    private static $publicKeyFilePath;
    private static $privateKeyFilePath;

    /**
     * @param array $configArgs
     */
    public static function setConfigArgs(array $configArgs): void{
        self::$configArgs = $configArgs;
    }


    /**
     * @param mixed $digest_alg
     */
    public static function setDigestAlg($digest_alg): void {
        self::$digest_alg = $digest_alg;
    }

    /**
     * @param mixed $privateKeyBits
     */
    public static function setPrivateKeyBits($privateKeyBits): void{
        self::$privateKeyBits = $privateKeyBits;
    }

    /**
     * @param mixed $configFile
     */
    public static function setConfigFile($configFile): void
    {
        self::$configFile = $configFile;
    }

    /**
     * @return mixed
     */
    public static function getDigestAlg(){
        return self::$digest_alg;
    }

    /**
     * @return mixed
     */
    public static function getPrivateKeyBits(){
        return self::$privateKeyBits;
    }

    /**
     * @return mixed
     */
    public static function getConfigFile(){
        return self::$configFile;
    }
    /**
     * @return array
     */
    public static function getConfigargs(): array{
        return self::$configargs;
    }


    public static function GenerateKey()
    {
        $gerar = openssl_pkey_new(self::$configargs);
            openssl_pkey_export($gerar, $keypriv, NULL, self::$configargs);
                $keypub = openssl_pkey_get_details($gerar);

        file_put_contents('privada.key', $keypriv);
            file_put_contents('publica.key', $keypub['key']);
    }

    public static function Testing($data)
    {
            $privateKey = openssl_pkey_get_private(file_get_contents('./privada.key'));
            openssl_private_encrypt($data, $cyph, $privateKey, OPENSSL_PKCS1_PADDING);
//            print_r();

        return $cyph;
    }
}

