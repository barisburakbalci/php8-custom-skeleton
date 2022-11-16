<?php

namespace Barisburakbalci\InterviewBankAccount\Model;

abstract class Account
{
    private int $customerId;
    private const DEPOSIT_FEE = 0.0003;
    private const WITHDRAW_FEE = 0.005;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }
    
    public function deposit(Transaction $transaction): float
    {
        return round($transaction->amountAsEuro * self::DEPOSIT_FEE, 2);
    }

    public function withdraw(Transaction $transaction): float
    {
        return round($transaction->amountAsEuro * self::WITHDRAW_FEE, 2);
    }
}