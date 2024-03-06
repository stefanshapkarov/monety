<?php

namespace App\Services;

class CurrencyConverterService
{
    protected $conversionRates = [
        'USD' => [
            'EUR' => 0.9217, // Euro
            'GBP' => 0.7885, // Great british pound
            'CHF' => 0.8857, // Swiss franc
            'JPY' => 150.2535, // Japanese yen
            'CAD' => 1.3593, // Canadian dollar
            'MKD' => 56.80 // Macedonian denar
        ],
        'EUR' => [
            'USD' => 1.0849, // American dollar
            'GBP' => 0.8554, // Great british pound
            'CHF' => 0.9609, // Swiss franc
            'JPY' => 163.0100, // Japanese yen
            'CAD' => 1.4747, // Canadian dollar
            'MKD' => 61.66 // Macedonian denar
        ],
        'GBP' => [
            'USD' => 1.2683, // American dollar
            'EUR' => 1.1690, // Euro
            'CHF' => 1.1233, // Swiss franc
            'JPY' => 190.5591, // Japanese yen
            'CAD' => 1.7239, // Canadian dollar
            'MKD' => 72.13 // Macedonian denar
        ],
        'CHF' => [
            'USD' => 1.1290, // American dollar
            'EUR' => 1.0407, // Euro
            'GBP' => 0.8902, // Great british pound
            'JPY' => 169.6430, // Japanese yen
            'CAD' => 1.5347, // Canadian dollar
            'MKD' => 64.24 // Macedonian denar
        ],
        'JPY' => [
            'USD' => 0.0067, // American dollar
            'EUR' => 0.0061, // Euro
            'GBP' => 0.0052, // Great british pound
            'CHF' => 0.0059, // Swiss franc
            'CAD' => 0.0090, // Canadian dollar
            'MKD' => 0.38 // Macedonian denar
        ],
        'CAD' => [
            'USD' => 0.7357, // American dollar
            'EUR' => 0.6781, // Euro
            'GBP' => 0.5801, // Great british pound
            'CHF' => 0.6516, // Swiss franc
            'JPY' => 110.5377, // Japanese yen
            'MKD' => 41.77 // Macedonian denar
        ],
        'MKD' => [
            'USD' => 0.018, // American dollar
            'EUR' => 0.016, // Euro
            'GBP' => 0.014, // Great british pound
            'CHF' => 0.016, // Swiss franc
            'JPY' => 2.64, // Japanese yen
            'CAD' => 0.024 // Canadian dollar
        ]
    ];

    public function convert($amount, $fromCurrency, $toCurrency)
    {
        // Check if conversion rates are defined for the specified currencies
        if (isset($this->conversionRates[$fromCurrency][$toCurrency])) {
            $exchangeRate = $this->conversionRates[$fromCurrency][$toCurrency];
            $convertedAmount = $amount * $exchangeRate;
            return $convertedAmount;
        } else {
            // Handle unsupported currency pair
            return null;
        }
    }
}
