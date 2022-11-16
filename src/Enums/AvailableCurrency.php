<?php

namespace Barisburakbalci\InterviewBankAccount\Enums;

enum AvailableCurrency: string
{
    case EUR = 'EUR';
    case USD = 'USD';
    case JPY = 'JPY';

    public static function fromName(string $name){

        return constant("self::$name");
    }
}