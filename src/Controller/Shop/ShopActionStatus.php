<?php

namespace App\Controller\Shop;

enum ShopActionStatus: string
{
    case PENDING = 'pending';
    case EXECUTED = 'executed';
    case FAILED = 'failed';

    public static function choices(): array
    {
        $strings = [];
        foreach (self::cases() as $case) {
            $strings[$case->value] = $case->name;
        }
        return $strings;
    }
}
