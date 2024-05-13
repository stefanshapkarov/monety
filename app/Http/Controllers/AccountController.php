<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\User;
use App\Utils\ConvertCurrencyUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class AccountController
{
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $request->amount;

        try {
            $account = Account::where('user_id', auth()->user()->id)->firstOrFail();
            $account->balance -= $amount;
            $account->save();
        } catch (Throwable $e) {
            return Redirect::route('dashboard')->with('error', 'There was a problem with the withdrawal, please try again later.');
        }

        return Redirect::route('dashboard')->with('success', 'The withdrawal was successful.');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $request->amount;

        try {
            $account = Account::where('user_id', auth()->user()->id)->firstOrFail();
            $account->balance += $amount;
            $account->save();
        } catch (Throwable $e) {
            return redirect()->route('dashboard')->with(['error' => 'There was a problem with the deposit, please try again later.']);
        }

        return redirect()->route('dashboard')->with(['success' => 'The deposit was successful.']);
    }
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
