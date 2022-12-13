<?php


namespace Tricioandrade\OpensCrypt;

class opensRSA
{
    private static $configArgs = array ();

    private static $digest_alg;
    private static $privateKeyBits;
    private static $configFile;

    private static $privateKey;
    private static $publicKey;

    private static $publicKeyFilePath;
    private static $privateKeyFilePath;

    private static $hash;

    public static $privateKeyEncrypt = 1;
    public static $publicKeyEncrypt = 2;
    public static $opensslSign = 3;

    /**
     * @param mixed $digest_alg
     */
    public static function setDigestAlg(string $digest_alg): void {
        self::$digest_alg = $digest_alg;
    }

    /**
     * @param mixed $privateKeyBits
     */
    public static function setPrivateKeyBits(int $privateKeyBits): void{
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
    private static function getDigestAlg(){
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
     */public static function getPublicKey() {
        return self::$publicKey;
    }

    /**
     * @return mixed
     */public static function getPrivateKey(){
        return self::$privateKey;
    }

    /**
     * @return mixed
     */
    private static function getConfigFile(){
        return self::$configFile;
    }

    /**
     * @param mixed $publicKeyFilePath
     */
    public static function setPublicKeyFilePathAndName($publicKeyFilePath): void {
        self::$publicKeyFilePath = $publicKeyFilePath;
    }

    /**
     * @return mixed
     */
    public static function getPrivateKeyFilePathAndName(){
        return self::$privateKeyFilePath;
    }

    /**
     * @param mixed $privateKeyFilePath
     */
    public static function setPrivateKeyFilePathAndName($privateKeyFilePath): void{
        self::$privateKeyFilePath = $privateKeyFilePath;
    }

    /**
     * @return mixed
     */public static function getPublicKeyFilePathAndName()
    {
        return self::$publicKeyFilePath;
    }

    /**
     * @return array
     */
    private static function getConfigArgs(): array{
        return self::$configArgs = [
            'config' => self::getConfigFile(),
            'private_key_bits' => self::getPrivateKeyBits(),
            'digest_alg' => self::getDigestAlg()
        ];
    }

    private static function generatedConfig(){
        return openssl_pkey_new(self::getConfigArgs());
    }

    public static function generateKeys()
    {
            openssl_pkey_export(self::generatedConfig(), $privateKey, NULL, self::getConfigArgs());
            self::$privateKey = $privateKey;
            self::$publicKey = openssl_pkey_get_details(self::generatedConfig());

            file_put_contents(self::getPrivateKeyFilePathAndName(), self::$privateKey);
            file_put_contents(self::getPublicKeyFilePathAndName(), self::$publicKey['key']);

    }

    public static function encrypt(string $data, int $generateWith = 3, bool $base64 = true, int $padding_algo = null)
    {
        switch($generateWith):
            case self::$privateKeyEncrypt:
                    $privateKey = openssl_pkey_get_private(file_get_contents(self::getPrivateKeyFilePathAndName()));
                    openssl_private_encrypt("${data}", $hash, $privateKey,( $padding_algo ?? OPENSSL_PKCS1_OAEP_PADDING));
                    self::$hash =  $hash;
                break;

            case self::$publicKeyEncrypt:
                    $publicKey = openssl_pkey_get_public(file_get_contents(self::getPublicKeyFilePathAndName()));
                    openssl_public_encrypt("${data}", $hash, $publicKey,( $padding_algo ?? OPENSSL_PKCS1_OAEP_PADDING));
                    self::$hash =  $hash;
                break;

            case self::$opensslSign:
                    $privateKey = openssl_pkey_get_private(file_get_contents(self::getPrivateKeyFilePathAndName()));
                    openssl_sign("${data}", $hash, $privateKey, ($padding_algo ?? OPENSSL_ALGO_SHA1));
                    self::$hash =  $hash;
                break;

        endswitch;

        return $base64 ? base64_encode(self::$hash) : self::$hash;
    }
}

