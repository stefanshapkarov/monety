<?php

namespace App\Services;

use App\Models\Transaction;

interface TransactionService
{
    public function performTransaction($amount, $toAccountEmail);

    public function sendFunds(Transaction $transaction);

    public function refundFunds(Transaction $transaction, $pending = false);
}
