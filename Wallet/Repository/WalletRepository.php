<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Wallet;

class WalletRepository extends \yii\db\ActiveRecord
{

    public function account($account_id, int $type, bool $asArray = false): ?array
    {
        $q = Wallet::find()->where(['account_id' => $account_id, 'type' => $type]);

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->all();
    }


    public function user($user_id, bool $asArray = false): ?array
    {
        $q = Wallet::find()->where(['user_id' => $user_id]);

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->all();
    }


    public function one(int $id): ?Wallet
    {
        return Wallet::find()->where(['id' => $id])->one();
    }

}