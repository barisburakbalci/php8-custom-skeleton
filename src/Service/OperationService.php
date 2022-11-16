<?php

namespace Barisburakbalci\InterviewBankAccount\Service;

use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;
use Barisburakbalci\InterviewBankAccount\Model\BusinessAccount;

class OperationService
{
    public static function getFees(array $transactions): array
    {
        $accounts = [];
        $fees = [];

        foreach ($transactions as $transaction) {
            if (array_key_exists($transaction->customerId, $accounts)) {
                $account = $accounts[$transaction->customerId];
            } else {
                $account = self::getAccountFor($transaction->customerId, $transaction->accountType);
                $accounts[$transaction->customerId] = $account;
            }

            switch ($transaction->operationType) {
                case 'deposit':
                    $fees[] = round($account->deposit($transaction), 2);
                    break;
                case 'withdraw':
                    $fees[] = round($account->withdraw($transaction), 2);
                    break;
            }
        }

        return $fees;
    }

    private static function getAccountFor(int $customerId, string $accountType): Account
    {
        if ($accountType == 'private') {
            return new PrivateAccount($customerId);
        }

        return new BusinessAccount($customerId);
    }
}