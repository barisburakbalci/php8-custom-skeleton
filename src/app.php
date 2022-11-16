<?php

namespace Barisburakbalci\InterviewBankAccount;

require_once './vendor/autoload.php';

use Barisburakbalci\InterviewBankAccount\Model\Transaction;
use Barisburakbalci\InterviewBankAccount\Service\CsvReader;
use Barisburakbalci\InterviewBankAccount\Service\OperationService;

$csvReader = new CsvReader('data.csv');
$transactionArray = $csvReader->toArray();
$transactions = [];

foreach ($transactionArray as $transactionData) {
    $transactions[] = new Transaction(...$transactionData);
}

$fees = OperationService::getFees($transactions);

foreach ($fees as $fee) {
    echo $fee . PHP_EOL;
}