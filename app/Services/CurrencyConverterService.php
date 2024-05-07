<?php

namespace App\Services;

use App\Models\CurrencyRate;
use http\Exception\InvalidArgumentException;

class CurrencyConverterService
{
    public static function convert($amount, $toCurrency)
    {
        $rate = CurrencyRate::findOrFail($toCurrency);
        return $amount / $rate['exchange_rate'];
    }
}
