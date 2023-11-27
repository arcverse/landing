<?php

namespace App\Controller\Shop;

enum ShopPaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case CHARGEBACK = 'chargeback';

    public static function choices(): array
    {
        $strings = [];
        foreach (self::cases() as $case) {
            $strings[$case->value] = $case->name;
        }
        return $strings;
    }
}
