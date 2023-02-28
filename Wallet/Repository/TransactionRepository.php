<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Transaction;


class TransactionRepository
{

    public function list(int $wallet_id, bool $asArray = false): ?array
    {
        $q = Transaction::find()->where(['wallet_id' => $wallet_id, 'status' => 1]);

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->all();
    }

}
