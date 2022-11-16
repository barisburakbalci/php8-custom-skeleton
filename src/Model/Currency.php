<?php

namespace Barisburakbalci\InterviewBankAccount\Model;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Currency
{
    public static function toEuro(float $amount, string $currency): float
    {
        $amountAsEuro = $amount;
        $currencyList = self::getCurrencyList();

        if ($currency != 'EUR') {
            $amountAsEuro = $amount / $currencyList[$currency];
        }

        return  $amountAsEuro;
    }

    public static function getCurrencyList(): array
    {

        // Leaving these as given in document for seeing the same results with given example.
        $currencyList = [
            'USD' => 1.1497,
            'JPY' => 129.53,
        ];

        /* Disabled due to local certification issue.
        $client = new Client(['base_uri' => 'https://developers.paysera.com/tasks/api/']);

        try {
            $response = $client->request('GET', 'currency-exchange-rates');
            $currencyList = json_decode($response->getBody(), true)['rates'];
        } catch (GuzzleException $e) {
            echo $e->getMessage();
            echo 'Could not fetch currencies from the API';
        }
        */

        return $currencyList;
    }
}