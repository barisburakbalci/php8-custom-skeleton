<?php

namespace Barisburakbalci\InterviewBankAccount;

require_once './vendor/autoload.php';

use Barisburakbalci\InterviewBankAccount\Enums\AccountType;
use Barisburakbalci\InterviewBankAccount\Enums\AvailableCurrency;
use Barisburakbalci\InterviewBankAccount\Enums\OperationType;
use Barisburakbalci\InterviewBankAccount\Model\Transaction;
use Barisburakbalci\InterviewBankAccount\Repository\AccountRepository;
use Barisburakbalci\InterviewBankAccount\Service\CsvReader;
use Barisburakbalci\InterviewBankAccount\Service\OperationService;

$csvReader = new CsvReader('data.csv');
$transactionArray = $csvReader->toArray();
$transactions = [];

foreach ($transactionArray as $transactionData) {
    $transactions[] = new Transaction(
        \DateTime::createFromFormat('Y-m-d', $transactionData[0]),
        intval($transactionData[1]),
        AccountRepository::getAccountFor(AccountType::fromName($transactionData[2]),$transactionData[1]),
        OperationType::fromName($transactionData[3]),
        floatval($transactionData[4]),
        AvailableCurrency::fromName($transactionData[5])
    );
}

$fees = OperationService::getFees($transactions);

foreach ($fees as $fee) {
    echo $fee . PHP_EOL;
}