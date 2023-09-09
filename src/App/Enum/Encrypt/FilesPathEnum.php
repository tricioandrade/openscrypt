<?php

namespace OpensCrypt\App\Enum\Encrypt;

enum FilesPathEnum: string
{
    case DEFAULT_KEY_PATH = '..\..\..\keys';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}