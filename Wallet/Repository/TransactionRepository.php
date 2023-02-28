<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Transaction;


class TransactionRepository
{

    public function list(?int $wallet_id, bool $asArray = false): ?array
    {
        $q = Transaction::find()->where(['status' => 1])->andFilterWhere(['wallet_id' => $wallet_id]);

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->orderBy('create_at DESC')->all();
    }

}
