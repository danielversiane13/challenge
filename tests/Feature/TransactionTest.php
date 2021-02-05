<?php

namespace Tests\Feature;

use App\Models\Category;
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
        $response->assertJsonCount(0, 'transactions');
    }

    public function test_should_returns_a_list_transactions()
    {
        $count = 3;
        Transaction::factory()->count($count)->create();

        $response = $this->get('/api/transactions');

        $response->assertStatus(200);
        $response->assertJsonCount($count, 'transactions');
        $response->assertJsonStructure([
            'transactions' => [['id', 'category_id', 'title', 'type', 'value', 'category' => ['id', 'title']]],
            'balance' => ['income', 'outcome', 'total']
        ]);
    }

    public function test_should_create_a_transaction()
    {
        $transaction = Transaction::factory()->make();
        $category = Category::first();

        $dataToSend = [
            'category' => $category->title,
            'title' => $transaction->title,
            'type' => $transaction->type,
            'value' => $transaction->value
        ];

        $response = $this->post('/api/transactions', $dataToSend);

        $response->assertStatus(200);
        $response->assertJson($transaction->toArray());
        $this->assertDatabaseCount('transactions', 1);
    }

    public function test_cannot_create_a_transacion_without_data()
    {
        $dataToSend = [];

        $response = $this->postJson('/api/transactions', $dataToSend);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['category', 'title', 'type', 'value']]);
    }

    public function test_cannot_create_a_transacion_when_send_invalid_type()
    {
        $dataToSend = Transaction::factory()->make(['type' => 'invalid-type']);

        $response = $this->postJson('/api/transactions', $dataToSend->toArray());

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['type']]);
    }
}
