<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use App\Utils\ConvertCurrencyUtil;
use Illuminate\Pagination\LengthAwarePaginator;
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
            $toAccountBalance = $toAccount->balance;

            if ($toAccountBalance < $toAmount) {
                throw new \Exception("refundFunds - Refund failed, not enough balance.");
            }

            $fromAccount->balance += $fromAmount;
            if (!$pending) {
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

    public static function getTransactions($filters = null)
    {
        $accountId = auth()->user()->account->id;

        if($filters) {
            $pendingTransactions = Transaction::with(['accountFrom.user', 'accountTo.user'])->where(function ($query) use ($accountId, $filters) {
                if (!empty($filters['email'])) {
                    $query->where(function ($query) use ($filters) {
                        $query->whereHas('accountFrom.user', function ($query) use ($filters) {
                            $query->where('email', 'like', "%{$filters['email']}%");
                        })->orWhereHas('accountTo.user', function ($query) use ($filters) {
                            $query->where('email', 'like', "%{$filters['email']}%");
                        });
                    });
                }

                if (!is_null($filters['received'])) {
                    if ($filters['received']) {
                        $query->where('to_account_id', $accountId);
                    } else {
                        $query->where('from_account_id', $accountId);
                    }
                } else {
                    $query->where(function ($query) use ($accountId) {
                        $query->where('from_account_id', $accountId)
                            ->orWhere('to_account_id', $accountId);
                    });
                }
            })
                ->where('status', 'pending')
                ->orderBy('updated_at', $filters['sortOrder'] ?? 'desc')
                ->get();

            $otherTransactions = Transaction::with(['accountFrom.user', 'accountTo.user'])->where(function ($query) use ($accountId, $filters) {
                if (!empty($filters['email'])) {
                    $query->where(function ($query) use ($filters) {
                        $query->whereHas('accountFrom.user', function ($query) use ($filters) {
                            $query->where('email', 'like', "%{$filters['email']}%");
                        })->orWhereHas('accountTo.user', function ($query) use ($filters) {
                            $query->where('email', 'like', "%{$filters['email']}%");
                        });
                    });
                }

                if (!is_null($filters['received'])) {
                    if ($filters['received']) {
                        $query->where('to_account_id', $accountId);
                    } else {
                        $query->where('from_account_id', $accountId);
                    }
                } else {
                    $query->where(function ($query) use ($accountId) {
                        $query->where('from_account_id', $accountId)
                            ->orWhere('to_account_id', $accountId);
                    });
                }
            })
                ->where('status', $filters['status'] ?? '<>', 'pending')
                ->orderBy('updated_at', $filters['sortOrder'] ?? 'desc')
                ->get();

            $transactions = $pendingTransactions->concat($otherTransactions);

            $perPage = 7;
            $currentPage = request()->get('page') ?: 1;
            $offset = ($currentPage - 1) * $perPage;
            $paginatedTransactions = new LengthAwarePaginator(
                $transactions->slice($offset, $perPage),
                $transactions->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url()]
            );

            $paginatedTransactions->onEachSide(1);

            return $paginatedTransactions;
        } else {
            // Get pending transactions
            $pendingTransactions = Transaction::where(function ($query) use ($accountId) {
                $query->where('from_account_id', $accountId)
                    ->orWhere('to_account_id', $accountId);
            })
                ->where('status', 'pending')
                ->with(['accountFrom.user', 'accountTo.user'])
                ->orderBy('updated_at', 'desc')
                ->get();

            $otherTransactions = Transaction::where(function ($query) use ($accountId) {
                $query->where('from_account_id', $accountId)
                    ->orWhere('to_account_id', $accountId);
            })
                ->where('status', '<>', 'pending')
                ->with(['accountFrom.user', 'accountTo.user'])
                ->orderBy('updated_at', 'desc')
                ->get();

            $transactions = $pendingTransactions->concat($otherTransactions);

            $perPage = 7;
            $currentPage = request()->get('page') ?: 1;
            $offset = ($currentPage - 1) * $perPage;
            $paginatedTransactions = new LengthAwarePaginator(
                $transactions->slice($offset, $perPage),
                $transactions->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url()]
            );

            $paginatedTransactions->onEachSide(1);

            return $paginatedTransactions;
        }

    }
}
