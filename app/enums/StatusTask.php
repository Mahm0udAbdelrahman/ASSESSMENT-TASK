<?php

namespace App\Enums;
enum StatusTask:int
{
    case pending = 1;
    case completed = 2;

    public static function availableTypes(): array
    {
        return [
            self::pending->value,
            self::completed->value,
        ];
    }
}
