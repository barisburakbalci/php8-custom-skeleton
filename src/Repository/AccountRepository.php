<?php

namespace Barisburakbalci\InterviewBankAccount\Repository;

use Barisburakbalci\InterviewBankAccount\Enums\AccountType;
use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\BusinessAccount;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;

class AccountRepository
{
    private static array $accounts = [];

    public static function getAccountFor(AccountType $accountType, int $customerId): Account
    {
        if (!array_key_exists($customerId, self::$accounts)) {
            $account = self::createAccount($accountType, $customerId);
            self::$accounts[$customerId] = &$account;
        }

        return self::$accounts[$customerId];
    }

    private static function createAccount(AccountType $accountType, int $customerId): Account
    {
        switch ($accountType) {
            case AccountType::BUSINESS:
                return new BusinessAccount($customerId);
            case AccountType::PRIVATE:
                return new PrivateAccount($customerId);
        }
    }
}