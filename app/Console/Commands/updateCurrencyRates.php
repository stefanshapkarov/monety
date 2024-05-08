<?php

namespace App\Console\Commands;

use App\Models\CurrencyRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class updateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Throwable
     */
    public function handle()
    {
        $apiKey = config('services.exchangerates.key');

        $currencyCodes = ['EUR', 'USD', 'MKD'];

        foreach ($currencyCodes as $code) {

            $response = Http::get('https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/' . $code);

            if ($response->successful()) {

                $rates = $response['conversion_rates'];

                $rates = json_encode(collect($rates)->filter(function ($rate, $code) {
                    return in_array($code, ['EUR', 'USD', 'MKD']);
                }));

                DB::transaction(function () use ($rates, $code) {
                    $currencyRate = CurrencyRate::find($code);

                    if (!$currencyRate) {
                        $currencyRate = new CurrencyRate();
                        $currencyRate->currency_code = $code;
                    }

                    $currencyRate->conversion_rates = $rates;

                    $currencyRate->save();
                });

                $this->info('Currency exchange rates fetch successful.');
            } else {
                $this->error('Currency exchange rates fetch unsuccessful.');
            }
        }
    }
}
