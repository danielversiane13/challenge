<?php

namespace App\Services\Transactions;

use App\Models\Transaction;

class ListTransactionService
{
    public function run()
    {
        $transactions = Transaction::with('category')->get();

        return $transactions;
    }
}
