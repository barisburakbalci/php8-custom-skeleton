<?php

declare(strict_types=1);

namespace Barisburakbalci\InterviewBankAccount\Tests\Model;

use Barisburakbalci\InterviewBankAccount\Model\Account;
use Barisburakbalci\InterviewBankAccount\Model\PrivateAccount;
use PHPUnit\Framework\TestCase;
use Barisburakbalci\InterviewBankAccount\Model\Transaction;

class CsvReaderTest extends TestCase
{
    private Account $account;

    public function setUp(): void
    {
        $this->account = new PrivateAccount(1);
    }

    public function testDeposit()
    {
        $transaction = new Transaction(
            '2014-12-31',
            '1',
            'private',
            'withdraw',
            '1200.00',
            'EUR'
        );
        $this->assertEquals(
            0.60,
            $this->account->withdraw($transaction)
        );
    }
}