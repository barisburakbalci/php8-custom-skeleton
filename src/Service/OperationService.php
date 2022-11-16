<?php

namespace Barisburakbalci\InterviewBankAccount\Service;

use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;
use Barisburakbalci\InterviewBankAccount\Model\BusinessAccount;

class OperationService
{
    public static array $accounts = [];

    public static function getFees(array $transactions): array
    {

        $fees = [];

        foreach ($transactions as $transaction) {
            $fees[] = $transaction->process();
        }

        return $fees;
    }
}