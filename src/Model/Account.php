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
        return $transaction->amount * self::DEPOSIT_FEE;
    }

    public function withdraw(Transaction $transaction): float
    {
        return $transaction->amount * self::WITHDRAW_FEE;
    }
}