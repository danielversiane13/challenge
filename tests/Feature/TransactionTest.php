<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_should_returns_a_list_empty()
    {
        $response = $this->get('/api/transactions');

        $response->assertStatus(200);
        $response->assertJsonCount(0);
    }

    public function test_should_returns_a_list_transactions()
    {
        $count = 3;
        Transaction::factory()->count($count)->create();

        $response = $this->get('/api/transactions');

        $response->assertStatus(200);
        $response->assertJsonCount($count);
        $response->assertJsonStructure([
            ['id', 'category_id', 'title', 'type', 'value', 'category' => ['id', 'title']]
        ]);
    }
}
