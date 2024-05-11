<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\User;
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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $loggedInUserId = auth()->id();

        // Perform the search query, excluding the logged-in user
        $accounts = User::where('id', '!=', $loggedInUserId) // Exclude the logged-in user
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
        })
            ->get();

        return $accounts;
    }
}
