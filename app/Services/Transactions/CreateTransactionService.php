<?php

namespace App\Services\Transactions;

use App\Models\Category;
use App\Models\Transaction;

class CreateTransactionService
{
    public function run(string $categoryTitle, string $title, string $type, float $value)
    {
        $category = Category::firstOrCreate(['title' => $categoryTitle]);

        $transaction = Transaction::create([
            'category_id' => $category->id,
            'title' => $title,
            'type' => $type,
            'value' => $value
        ]);

        return $transaction;
    }
}
