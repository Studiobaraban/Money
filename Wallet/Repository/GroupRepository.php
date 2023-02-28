<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Group;

class GroupRepository extends \yii\db\ActiveRecord
{

    public function list($account_id, bool $asArray = false): ?array
    {
        $q = Group::find()->where(['group.account_id' => $account_id, 'group.del' => 0])->joinWith('categories');

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->all();
    }


    public function one(int $id): ?Group
    {
        return Group::find()->where(['id' => $id])->one();
    }

}