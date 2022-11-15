<?php

namespace Barisburakbalci\InterviewBankAccount\Service;

use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;
use Barisburakbalci\InterviewBankAccount\Model\BusinessAccount;
use Barisburakbalci\InterviewBankAccount\Model\Transaction;

class OperationService
{
    public static function main(): void
    {
        $csvReader = new CsvReader('data.csv');
        $transactionArray = $csvReader->toArray();
        $transactions = [];
        foreach ($transactionArray as $transactionData) {
            $transactions[] = new Transaction(...$transactionData);
        }
        self::processTransactions($transactions);
    }

    private static function processTransactions(array $transactions): void
    {
        $accounts = [];

        foreach ($transactions as $transaction) {
            if (array_key_exists($transaction->customerId, $accounts)) {
                $account = $accounts[$transaction->customerId];
            } else {
                $account = self::getAccountFor($transaction->customerId, $transaction->accountType);
                $accounts[$transaction->customerId] = $account;
            }
            switch ($transaction->operationType) {
                case 'deposit':
                    echo round($account->deposit($transaction), 2) . PHP_EOL;
                    break;
                case 'withdraw':
                    echo round($account->withdraw($transaction), 2) . PHP_EOL;
                    break;
            }
        }
    }

    private static function getAccountFor(int $customerId, string $accountType): Account
    {
        if ($accountType == 'private') {
            return new PrivateAccount($customerId);
        }

        return new BusinessAccount($customerId);
    }
}