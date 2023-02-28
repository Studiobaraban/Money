<?php

namespace app\User\Repository;

use app\User\Entity\Account;

class AccountRepository extends \yii\db\ActiveRecord
{

    public function one(int $id, bool $asArray = false)
    {
        $q = Account::find()->where(['account.id' => $id])->joinWith('users');

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->one();
    }
}
