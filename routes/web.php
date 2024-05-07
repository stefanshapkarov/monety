<?php

use App\Http\Controllers\TransactionController;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\CurrencyConverterService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $currencyConverter = new CurrencyConverterService();

        return Inertia::render('Dashboard', [
            // Passing the account object for testing purposes
            'currentAccount' => auth()->user()->account,
            'sentTransactions' => Transaction::where('from_account_id', auth()->user()->account->id)->get(),
            'receivedTransactions' => Transaction::where('to_account_id', auth()->user()->account->id)->get(),
            'convertedCurrency' => $currencyConverter->convert(200, 'MKD')
        ]);
    })->name('dashboard');

    Route::post('/transfer-funds', [TransactionController::class, 'store'])->name('transfer-funds');
    Route::get('/refund-transaction/{transaction:id}', [TransactionController::class, 'refund'])
        ->name('refund-transaction');
    Route::get('/complete-transaction/{transaction:id}', [TransactionController::class, 'complete'])
        ->name('complete-transaction');

    Route::get('/withdraw', fn() => Inertia::render('Withdraw', [
//        'currentAccount' => auth()->user()->account,
    ]));
});
