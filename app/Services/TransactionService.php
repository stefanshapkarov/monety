<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use App\Utils\ConvertCurrencyUtil;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * @throws \Throwable
     */
    public function create($amount, $toAccountEmail)
    {
        DB::transaction(function () use ($amount, $toAccountEmail) {
            $fromAccount = auth()->user()->account;
            $toUser = User::where('email', $toAccountEmail)->firstOrFail();
            $toAccount = Account::where('user_id', $toUser->id)->firstOrFail();

            $fromAccountCurrency = $fromAccount->currency;
            $toAccountCurrency = $toAccount->currency;

            $fromAmount = $amount;
            $toAmount = $amount;
            if ($fromAccountCurrency != $toAccountCurrency) {
                $toAmount = ConvertCurrencyUtil::convert($amount, $fromAccountCurrency, $toAccountCurrency);
            }

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
                'fromAmount' => $fromAmount,
                'toAmount' => $toAmount,
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
            $amount = $transaction->toAmount;
            $toAccount->balance += $amount;
            $toAccount->save();
            $transaction->status = 'completed';
            $transaction->save();
        });
    }

    public function refundFunds(Transaction $transaction, $pending = false)
    {
        DB::transaction(function () use ($transaction, $pending) {
            $fromAccount = Account::findOrFail($transaction->from_account_id);
            $toAccount = Account::findOrFail($transaction->to_account_id);
            $fromAmount = $transaction->fromAmount;
            $toAmount = $transaction->toAmount;

            $fromAccount->balance += $fromAmount;
            if (!$pending) {
                $toAccountBalance = $toAccount->balance;
                $toAccountBalance -= $toAmount;
                if ($toAccountBalance < 0.0001) {
                    $toAccountBalance = 0;
                }
                $toAccount->balance = $toAccountBalance;
                $toAccount->save();
            }
            $fromAccount->save();

            $transaction->status = 'refunded';
            $transaction->save();
        });
    }
}
