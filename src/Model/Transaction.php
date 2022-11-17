<?php

namespace Barisburakbalci\InterviewBankAccount\Model;

use Barisburakbalci\InterviewBankAccount\Enums\AvailableCurrency;
use Barisburakbalci\InterviewBankAccount\Enums\OperationType;
use Barisburakbalci\InterviewBankAccount\Service\Currency;
use DateTime;
use Exception;

class Transaction
{
    public float $amountAsEuro;

    public function __construct(
        public DateTime $date,
        public Account $account,
        public OperationType $operationType,
        public float $amount,
        public AvailableCurrency $currency
    )
    {
        $this->amountAsEuro = Currency::toEuro($this->currency, $this->amount);
    }

    public function process(): float
    {
        switch ($this->operationType) {
            case OperationType::DEPOSIT:
                return $this->account->deposit($this);
            case OperationType::WITHDRAW:
                return $this->account->withdraw($this);
            default:
                throw new Exception('Unsupported operation!');
        }
    }
}