<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'currentAccount' => User::with('account')->find(auth()->id()),
            'transactions' => TransactionService::getTransactions(),
            'success' => $request->session()->pull('success'),
            'error' => $request->session()->pull('error')
        ]);
    }

    public function applyFilters(Request $request)
    {
        $filters = $request->only(['email', 'received', 'status', 'sortOrder']);

        return  TransactionService::getTransactions($filters);
    }
}
