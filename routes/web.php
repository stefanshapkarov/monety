<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Utils\ConvertCurrencyUtil;
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

        return Inertia::render('Dashboard', [
            // Passing the account object for testing purposes
            'currentAccount' => auth()->user()->account,
            'transactions' => Transaction::where('from_account_id', auth()->user()->account->id)->orWhere('to_account_id', '=', \auth()->user()->account->id)->with('accountFrom', 'accountTo')->orderBy('created_at', 'desc')->paginate(7)->onEachSide(1),
            'convertedCurrency' => ConvertCurrencyUtil::convert(200, 'EUR', 'MKD')
        ]);
    })->name('dashboard');

    Route::get('/search/accounts', [AccountController::class, 'search']);

    Route::patch('/account/updateCurrency', [AccountController::class, 'updateCurrency'])
        ->name('account.updateCurrency');

    Route::post('/transfer-funds', [TransactionController::class, 'store'])->name('transfer-funds');
    Route::get('/refund-transaction/{transaction:id}', [TransactionController::class, 'refund'])
        ->name('refund-transaction');
    Route::get('/complete-transaction/{transaction:id}', [TransactionController::class, 'complete'])
        ->name('complete-transaction');

    Route::get('/withdraw', fn() => Inertia::render('Withdraw', [
//        'currentAccount' => auth()->user()->account,
    ]));
});
