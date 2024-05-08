<?php

namespace App\Utils;

use App\Models\CurrencyRate;

class ConvertCurrencyUtil
{
    public static function convert($amount, $fromCurrency, $toCurrency)
    {
        $fromCurrencyRate = CurrencyRate::find($fromCurrency);

        $ratesJson = $fromCurrencyRate['conversion_rates'];

        $rate = json_decode($ratesJson, true)[$toCurrency];

        return $amount * $rate;
    }
}
