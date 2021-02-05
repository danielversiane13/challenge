<?php

namespace App\Services\Transactions;

use Illuminate\Support\Collection;

class GetBalanceService
{
    public function run(Collection $transactions)
    {
        $balance = $transactions->reduce(function ($acc, $val) {
            $acc[$val->type] += $val->value;

            return $acc;
        }, ['income' => 0, 'outcome' => 0]);

        $balance['total'] = $balance['income'] - $balance['outcome'];

        return $balance;
    }
}
