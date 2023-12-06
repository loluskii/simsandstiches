<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $total = Payment::sum('amount');
        $transactions = Payment::all();
        return view('admin.transactions.index', compact('total', 'transactions'));
    }
}
