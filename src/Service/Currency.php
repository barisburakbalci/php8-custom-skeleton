<?php

namespace Barisburakbalci\InterviewBankAccount\Service;

use Barisburakbalci\InterviewBankAccount\Enums\AvailableCurrency;

class Currency
{
    public const CURRENCIES = [
        'EUR' => 1,
        'USD' => 1.1497,
        'JPY' => 129.53,
    ];

    public static function toEuro(AvailableCurrency $from, float $amount): float
    {
        return $amount / self::CURRENCIES[$from->value];
    }

    public static function fromEuro(AvailableCurrency $to, float $amount): float
    {
        return $amount * self::CURRENCIES[$to->value];
    }
}