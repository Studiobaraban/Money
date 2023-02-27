<?php

namespace app\Wallet\Repository;

use app\Wallet\Entity\Category;

class CategoryRepository extends \yii\db\ActiveRecord
{

    public function list($account_id, bool $asArray = false): ?array
    {
        $q = Category::find()->where(['account_id' => $account_id, 'del' => 0]);

        if (!empty($asArray)) {
            $q->asArray();
        }

        return $q->all();
    }


    public function one(int $id): ?Category
    {
        return Category::find()->where(['id' => $id])->one();
    }

}