<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * @throws \Throwable
     */
    public function performTransaction($amount, $toAccountEmail)
    {
        DB::transaction(function () use ($amount, $toAccountEmail) {
            $fromAccount = auth()->user()->account;
            $toUser = User::where('email', $toAccountEmail)->firstOrFail();
            $toAccount = Account::where('user_id', $toUser->id)->firstOrFail();

            if ($fromAccount->id == $toAccount->id) {
                throw new \Exception("You can't make a transaction to yourself.");
            }

            if ($fromAccount->balance < $amount) {
                throw new \Exception("Not enough balance to make transaction.");
            }

            $fromAccount->balance -= $amount;
            $fromAccount->save();

            Transaction::create([
                'from_account_id' => $fromAccount->id,
                'to_account_id' => $toAccount->id,
                'amount' => $amount
            ]);
        });
    }

    /**
     * @throws \Throwable
     */
    public function sendFunds(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $toAccount = Account::findOrFail($transaction->to_account_id);
            $amount = $transaction->amount;

            $toAccount->balance += $amount;
            $toAccount->save();
            $transaction->status = 'completed';
            $transaction->save();
        });
    }

    public function refundFunds(Transaction $transaction, $pending = false)
    {
        DB::transaction(function () use ($transaction, $pending) {
            $toAccount = Account::findOrFail($transaction->from_account_id);
            $fromAccount = Account::findOrFail($transaction->to_account_id);
            $amount = $transaction->amount;

            $toAccount->balance += $amount;
            if (!$pending) {
                $fromAccount->balance -= $amount;
                $fromAccount->save();
            }
            $toAccount->save();

            $transaction->status = 'refunded';
            $transaction->save();
        });
    }
}
