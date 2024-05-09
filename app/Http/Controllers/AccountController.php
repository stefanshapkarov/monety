<?php

namespace App\Http\Controllers;


use App\Utils\ConvertCurrencyUtil;
use Illuminate\Http\Request;

class AccountController
{
    public function updateCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|in:USD,EUR,MKD',
        ]);

        $account = auth()->user()->account;

        $oldCurrency = $account->currency;
        $newCurrency = $request['currency'];

        $account->balance = ConvertCurrencyUtil::convert($account->balance, $oldCurrency, $newCurrency);

        $account->currency = $newCurrency;

        $account->save();

        return redirect()->back()->with('success', 'Currency updated successfully!');
    }
}
