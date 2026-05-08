<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case VISA = 'visa';
    case WALLET = 'wallet';
    case INSTALLMENTS = 'installments';

    public function label(): string
    {
        return match($this) {
            self::CASH => 'Cash on Delivery',
            self::VISA => 'Credit / Debit Card',
            self::WALLET => 'Mobile Wallet',
            self::INSTALLMENTS => 'Monthly Installments',
        };
    }
}