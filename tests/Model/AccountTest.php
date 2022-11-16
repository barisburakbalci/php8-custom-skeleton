<?php

declare(strict_types=1);

namespace Barisburakbalci\InterviewBankAccount\Tests\Model;

use Barisburakbalci\InterviewBankAccount\Enums\AccountType;
use Barisburakbalci\InterviewBankAccount\Enums\AvailableCurrency;
use Barisburakbalci\InterviewBankAccount\Enums\OperationType;
use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\BusinessAccount;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;
use Barisburakbalci\InterviewBankAccount\Repository\AccountRepository;
use DateTime;
use PHPUnit\Framework\TestCase;
use Barisburakbalci\InterviewBankAccount\Model\Transaction;

class CsvReaderTest extends TestCase
{
    public Account $privateAccount;
    public Account $businessAccount;

    public function setUp(): void
    {
        $this->privateAccount = new PrivateAccount(1);
        $this->businessAccount = new BusinessAccount(2);
    }

    public function testWithdrawForPrivateAccount()
    {
        $transaction = new Transaction(
            DateTime::createFromFormat('Y-m-d', '2014-12-31'),
            1,
            AccountRepository::getAccountFor(AccountType::PRIVATE, 1),
            OperationType::WITHDRAW,
            1200.00,
            AvailableCurrency::EUR
        );
        $this->assertEquals(
            0.60,
            $this->privateAccount->withdraw($transaction)
        );
    }

    public function testWithdrawForBusinessAccount()
    {
        $transaction = new Transaction(
            DateTime::createFromFormat('Y-m-d', '2016-01-06'),
            2,
            AccountRepository::getAccountFor(AccountType::BUSINESS, 2),
            OperationType::WITHDRAW,
            300.00,
            AvailableCurrency::EUR
        );
        $this->assertEquals(
            1.50,
            $this->businessAccount->withdraw($transaction)
        );
    }

    public function testDepositForPrivateAccount()
    {
        $transaction = new Transaction(
            DateTime::createFromFormat('Y-m-d', '2016-01-05'),
            1,
            AccountRepository::getAccountFor(AccountType::PRIVATE, 1),
            OperationType::DEPOSIT,
            200.00,
            AvailableCurrency::EUR
        );
        $this->assertEquals(
            0.06,
            $this->privateAccount->deposit($transaction)
        );
    }

    public function testDepositForBusinessAccount()
    {
        $transaction = new Transaction(
            DateTime::createFromFormat('Y-m-d', '2016-01-10'),
            2,
            AccountRepository::getAccountFor(AccountType::BUSINESS, 2),
            OperationType::DEPOSIT,
            10000.00,
            AvailableCurrency::EUR
        );
        $this->assertEquals(
            3,
            $this->businessAccount->deposit($transaction)
        );
    }
}