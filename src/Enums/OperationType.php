<?php

namespace Barisburakbalci\InterviewBankAccount\Enums;

enum OperationType: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';

    public static function fromName(string $name){
        $name = strtoupper($name);
        return constant("self::$name");
    }
}