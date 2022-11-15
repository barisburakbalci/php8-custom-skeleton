<?php

namespace Barisburakbalci\InterviewBankAccount\Model;

class Transaction
{
    public float $amountAsEuro;
    public int $customerId;
    public float $amount;
    public string $week;
    public \DateTime $date;

    public function __construct(
        string $date,
        string $customerId,
        public string $accountType,
        public string $operationType,
        string $amount,
        public string $currency
    )
    {
        $this->customerId = (int) $customerId;
        $this->amount = (float) $amount;
        $this->amountAsEuro = $this->convertToEuro($this->amount, $this->currency);
        $this->date = \DateTime::createFromFormat('Y-m-d', $date);
    }

    public function convertToEuro(float $amount, string $currency) : float
    {
        $amountAsEuro = $amount;

        switch ($currency) {
            case 'USD':
                $amountAsEuro = $amount / 1.1497;
                break;
            case 'JPY':
                $amountAsEuro = $amount / 129.53;
                break;
        }

        return $amountAsEuro;
    }
}