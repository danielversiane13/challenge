<?php

namespace App\Services\Transactions;

use App\Models\Category;
use App\Models\Transaction;

class CreateTransactionService
{
    public function run(string $categoryTitle, string $title, string $type, float $value)
    {
        $category = Category::where('title', $categoryTitle)->first();
        if (!$category) $category = Category::create(['title' => $categoryTitle]);

        $transaction = Transaction::create([
            'category_id' => $category->id,
            'title' => $title,
            'type' => $type,
            'value' => $value
        ]);

        return $transaction;
    }
}
