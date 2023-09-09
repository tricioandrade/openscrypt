<?php

namespace OpensCrypt\App\Enum\Encrypt;

enum EncryptionTypesEnum: int
{
    case PRIVATE_KEY_ENCRYPTION = 990;
    case PUBLIC_KEY_ENCRYPTION  = 991;
    case OPEN_SSL_SIGN          = 992;


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}