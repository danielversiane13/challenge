<?php

namespace Tests\Unit\Services\Transactions;

use App\Models\Transaction;
use App\Services\Transactions\ListTransactionService;
use Tests\TestCase;

class ListTransactionServiceTest extends TestCase
{
    public function test_should_return_a_list_empty()
    {
        $listTransactionService = new ListTransactionService;
        $list = $listTransactionService->run();

        $this->assertEquals([], $list->toArray());
    }

    public function test_should_return_a_list_transactions()
    {
        $count = 3;
        Transaction::factory()->count($count)->create();

        $listTransactionService = new ListTransactionService;
        $list = $listTransactionService->run();

        $transactions = Transaction::with('category')->get();
        $this->assertCount($count, $list);
        $this->assertEquals($transactions->toArray(), $list->toArray());
    }
}
