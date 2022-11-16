<?php

namespace Barisburakbalci\InterviewBankAccount;

require_once './vendor/autoload.php';

use Barisburakbalci\InterviewBankAccount\Enums\AccountType;
use Barisburakbalci\InterviewBankAccount\Enums\AvailableCurrency;
use Barisburakbalci\InterviewBankAccount\Enums\OperationType;
use Barisburakbalci\InterviewBankAccount\Model\Transaction;
use Barisburakbalci\InterviewBankAccount\Repository\AccountRepository;
use Barisburakbalci\InterviewBankAccount\Service\CsvReader;
use DateTime;

$csvReader = new CsvReader('data.csv');
$transactions = $csvReader->toArray();
$fees = [];

foreach ($transactions as $transactionAsArray) {
    $transaction = new Transaction(
        DateTime::createFromFormat('Y-m-d', $transactionAsArray[0]),
        intval($transactionAsArray[1]),
        AccountRepository::getAccountFor(AccountType::fromName($transactionAsArray[2]),$transactionAsArray[1]),
        OperationType::fromName($transactionAsArray[3]),
        floatval($transactionAsArray[4]),
        AvailableCurrency::fromName($transactionAsArray[5])
    );
    echo $transaction->process() . PHP_EOL;
}
