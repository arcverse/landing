<?php

namespace App\Controller\Shop;

enum ShopPaymentProvider: string
{
    case PAYPAL = 'PayPal';

    public static function choices(): array
    {
        $strings = [];
        foreach (self::cases() as $case) {
            $strings[$case->value] = $case->name;
        }
        return $strings;
    }
}
