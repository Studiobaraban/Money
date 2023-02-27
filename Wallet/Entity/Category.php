<?php

namespace app\Wallet\Entity;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $account_id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property int $del
 *
 */
class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }


    public function rules()
    {
        return [
            [['account_id', 'name'], 'required'],
            [['id', 'account_id', 'status', 'del'], 'integer'],
            [['name', 'description'], 'string'],
        ];
    }

}
