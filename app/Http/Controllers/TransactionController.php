<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'email' => 'required|exists:users,email'
        ]);

        $amount = $request->amount;
        $toAccountEmail = $request->email;

        try {
            DB::transaction(function () use ($amount, $toAccountEmail) {
                $fromAccount = auth()->user()->account;
                $toUser = User::where('email', $toAccountEmail)->firstOrFail();
                $toAccount = Account::where('user_id', $toUser->id)->firstOrFail();

                if ($fromAccount->balance < $amount) {
                    return redirect('/dashboard')->with(['error' => "Not enough balance to make transaction."]);
                }

                $fromAccount->balance -= $amount;
                $toAccount->balance += $amount;
                $fromAccount->save();
                $toAccount->save();

                Transaction::create([
                    'from_account_id' => $fromAccount->id,
                    'to_account_id' => $toAccount->id,
                    'amount' => $amount
                ]);
            });
        } catch (Throwable $e) {
            return redirect('/dashboard')->with(['error' => 'There was a problem with the transaction, please try again later.']);
        }

        return redirect('/dashboard')->with(['success' => 'The transaction was successful.']);
    }
}
