<?php

namespace Tests\Unit\Services\Transactions;

use App\Models\Category;
use App\Models\Transaction;
use App\Services\Transactions\CreateTransactionService;
use Tests\TestCase;

class CreateTransactionServiceTest extends TestCase
{
    public function test_can_create_a_transaction()
    {
        $transaction = Transaction::factory()->make();
        $category = Category::first();

        $createTransactionService = new CreateTransactionService;

        $return = $createTransactionService->run(
            $category->title,
            $transaction->title,
            $transaction->type,
            $transaction->value
        );

        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseHas('transactions', $transaction->toArray());
    }
}
