<?php

namespace Tests\Unit\Services\Transactions;

use App\Models\Transaction;
use App\Services\Transactions\GetBalanceService;
use Tests\TestCase;

class GetBalanceServiceTest extends TestCase
{
    public function test_example()
    {
        Transaction::factory()->count(5)->create(['type' => 'income', 'value' => 300]);
        Transaction::factory()->count(2)->create(['type' => 'outcome', 'value' => 250]);

        $transactions = Transaction::get();

        $getBalanceService = new GetBalanceService;
        $balance = $getBalanceService->run($transactions);

        $this->assertEquals(['income' => 1500, 'outcome' => 500, 'total' => 1000], $balance);
    }
}
