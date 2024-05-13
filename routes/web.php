<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\User;
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
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
})->name('logout');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/filters', [DashboardController::class, 'applyFilters'])->name('dashboard.filters');
    Route::get('/dashboard/filters', [DashboardController::class, 'applyFilters'])->name('dashboard.filters.get');


    Route::get('/search/accounts', [AccountController::class, 'search']);

    Route::patch('/account/updateCurrency', [AccountController::class, 'updateCurrency'])
        ->name('account.updateCurrency');

    Route::post('/transfer-funds', [TransactionController::class, 'store'])->name('transfer-funds');
    Route::get('/refund-transaction/{transaction:id}', [TransactionController::class, 'refund'])
        ->name('refund-transaction');
    Route::get('/complete-transaction/{transaction:id}', [TransactionController::class, 'complete'])
        ->name('complete-transaction');

    Route::post('/withdraw', [AccountController::class, 'withdraw'])->name('withdraw');
    Route::post('/deposit', [AccountController::class, 'deposit'])->name('deposit');
});
