<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Transaction;


class TransactionRepository
{

    public function list(?int $wallet_id, bool $asArray = false): ?array
    {
        $q = Transaction::find()->select(['transaction.*', 'wallet.name as wallet', 'wallet.user_id as wallet_user', 'wallet.currency'])
            ->where(['transaction.status' => 1])->andFilterWhere(['transaction.wallet_id' => $wallet_id])
            ->join('LEFT JOIN', 'wallet', 'wallet.id = transaction.wallet_id');

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->orderBy('create_at DESC')->all();
    }

}
