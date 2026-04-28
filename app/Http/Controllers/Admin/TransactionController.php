<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('booking.user')
            ->latest()
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with([
            'booking',
            'booking.user',
            'logs'
        ])->findOrFail($id);

        return view('admin.transactions.show', compact('transaction'));
    }
}