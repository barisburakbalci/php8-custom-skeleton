<?php

declare(strict_types=1);

namespace Barisburakbalci\InterviewBankAccount\Tests\Service;

use PHPUnit\Framework\TestCase;
use Barisburakbalci\InterviewBankAccount\Service\CsvReader;

class CsvReaderTest extends TestCase
{
    /**
     * @var CsvReader
     */
    private $csvReader;

    public function setUp(): void
    {
        $this->csvReader = new CsvReader('data.csv');
    }

    public function testFileExistance()
    {
        $this->assertFileExists(
            'data.csv',
            'Test file data.csv exists'
        );
    }

    /**
     * @param string $date
     * @param int $userId
     * @param string $accountType
     * @param string $operationType
     * @param float $amount
     * @param string $currency
     *
     * @dataProvider dataProviderForReadlineTesting
     */
    public function testReadline(
        string $date,
        int $userId,
        string $accountType,
        string $operationType,
        float $amount,
        string $currency
    )
    {
        $currencyList = ['EUR', 'JPY', 'USD'];
        $this->assertContains($currency, $currencyList);
    }

    public function dataProviderForReadlineTesting(): array
    {
        $this->csvReader = new CsvReader('data.csv');
        $transactions = $this->csvReader->toArray();
        $testInput = [];
        foreach ($transactions as $line => $transaction) {
            $transaction[1] = (int) $transaction[1];
            $transaction[4] = (float) $transaction[4];
            $testInput['test for csv line ' . $line] = $transaction;
        }
        return $testInput;
    }
}
