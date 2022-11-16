<?php

namespace Barisburakbalci\InterviewBankAccount\Enums;

enum AccountType: string
{
    case PRIVATE = 'deposit';
    case BUSINESS = 'withdraw';

    public static function fromName(string $name){
        $name = strtoupper($name);
        return constant("self::$name");
    }
}