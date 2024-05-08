<?php

namespace App\Services;

use App\Models\CurrencyRate;
use http\Exception\InvalidArgumentException;

class CurrencyConverterService
{
    public static function convert($amount, $fromCurrency, $toCurrency)
    {
        $fromCurrencyRate = CurrencyRate::find($fromCurrency);

        $ratesJson = $fromCurrencyRate['conversion_rates'];

        $rate = json_decode($ratesJson, true)[$toCurrency];

        return $amount * $rate;
    }
}
