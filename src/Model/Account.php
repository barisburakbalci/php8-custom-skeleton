<?php

namespace Barisburakbalci\InterviewBankAccount\Tests\Model;

abstract class Account {
    private float $depositFee = 0.03;
    private float $withDrawFee = 0.03;
    private array $transactions;

    public function deposit(Transaction $depositTransaction) : float
    {
        $sameWeekFilter = function($transaction) use ($depositTransaction) {
            $isSameWeek = date('W', $transaction->date) == date('W', $depositTransaction->date);
            $isDeposit = $transaction->operation == 'deposit';
            return $isDeposit && $isSameWeek;
        };
        $sameWeekTransactions = array_filter($this->transaction, $sameWeekFilter);
        
    }
}