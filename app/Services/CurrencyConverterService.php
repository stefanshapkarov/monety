<?php

namespace App\Services;

use App\Models\CurrencyRate;
use http\Exception\InvalidArgumentException;

class CurrencyConverterService
{
    public function convert($amount, $toCurrency)
    {
        $rate = CurrencyRate::find($toCurrency);
        if ($rate) {
            return $amount * $rate['exchange_rate'];
        } else {
            throw new InvalidArgumentException();
        }
    }
}
