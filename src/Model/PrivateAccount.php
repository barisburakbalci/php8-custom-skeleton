<?php

namespace Barisburakbalci\InterviewBankAccount\Model;

use Barisburakbalci\InterviewBankAccount\Enums\OperationType;
use DateTime;

class PrivateAccount extends Account {
    private const DEPOSIT_FEE = 0.0003;
    private const WITHDRAW_FEE = 0.003;
    private const WEEKLY_FREE_WITHDRAWAL_COUNT = 3;
    private const WEEKLY_FREE_WITHDRAWAL_AMOUNT = 1000;
    private array $withdrawals = [];

    public function withdraw(Transaction $transaction): float
    {
        $sameWeekTransactions = $this->getSameWeekWithdrawals($transaction->date);
        $remainingFreeWithdrawAmount = $this->getRemainingFreeWithdrawalAmount($sameWeekTransactions);
        $this->withdrawals[] = $transaction;

        return $this->calculateWithdrawalFee($transaction->amountAsEuro - $remainingFreeWithdrawAmount);
    }

    public function calculateWithdrawalFee(float $withdrawAmount): float
    {
        return round($withdrawAmount > 0 ? $withdrawAmount * $this::WITHDRAW_FEE : 0, 2);
    }

    public function getSameWeekWithdrawals(DateTime $date): array
    {
        $sameWeekFilter = function($transaction) use ($date) {
            $dateDiff = $date->diff($transaction->date);
            $isSameWeek = !floor($dateDiff->format('%a') / 7);
            $isWithdraw = $transaction->operationType == OperationType::WITHDRAW;
            return $isWithdraw && $isSameWeek;
        };

        return array_filter($this->withdrawals, $sameWeekFilter);
    }

    public function getSumAsEuros(array $transactions): float
    {
        $amountsAsEuros = array_map(fn($transaction) => $transaction->amountAsEuro, $transactions);
        return array_sum($amountsAsEuros);
    }

    public function getRemainingFreeWithdrawalAmount(array $transactions): float
    {
        $freeWithdrawAmount = 0;

        if (count($transactions) <= self::WEEKLY_FREE_WITHDRAWAL_COUNT) {
            $sameWeekSumAsEuros = $this->getSumAsEuros($transactions);
            if ($sameWeekSumAsEuros < self::WEEKLY_FREE_WITHDRAWAL_AMOUNT) {
                $freeWithdrawAmount = self::WEEKLY_FREE_WITHDRAWAL_AMOUNT - $sameWeekSumAsEuros;
            }
        }

        return $freeWithdrawAmount;
    }
}