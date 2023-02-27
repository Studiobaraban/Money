<?php

namespace app\Wallet\Entity;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $user_id
 * @property int $wallet_id
 * @property string $category_id
 * @property string $description
 * @property float $sum
 * @property string $create_at
 * @property int $status
 *
 */
class Transaction extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'transaction';
    }


    public function rules()
    {
        return [
            [['user_id', 'wallet_id', 'sum', 'category_id'], 'required'],
            [['id', 'user_id', 'wallet_id', 'category_id', 'status'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['sum'], 'number'],
            [['create_at'], 'safe'],
        ];
    }
}
