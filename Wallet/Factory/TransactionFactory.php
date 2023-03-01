<?php

namespace app\Wallet\Factory;

use app\Wallet\Entity\Transaction;
use app\Wallet\Entity\Wallet;

class TransactionFactory
{
    public function create(Wallet $wallet, int $category_id, float $sum, int $type, string $description = null): Transaction
    {
        $transaction = new Transaction();
        $transaction->user_id = $wallet->user_id;
        $transaction->wallet_id = $wallet->id;
        $transaction->category_id = $category_id;
        $transaction->sum = $sum;
        $transaction->description = $description;
        $transaction->type = $type;
        $transaction->status = 1;
        $transaction->save();

        if ($type < 3) {
            $wallet->balance = $wallet->balance + $sum;
            $wallet->save();
        }

        return $transaction;
    }


}