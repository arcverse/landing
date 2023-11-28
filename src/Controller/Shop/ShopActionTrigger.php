<?php

namespace App\Controller\Shop;

enum ShopActionTrigger: string
{
    case PURCHASE = "on purchase";
    case REMOVE = "on remove";
    case REFUND = "on refund";
    case CHARGEBACK = "on chargeback";


    public static function choices(): array
    {
        $strings = [];
        foreach (self::cases() as $case) {
            $strings[$case->value] = $case->name;
        }
        return $strings;
    }
}
