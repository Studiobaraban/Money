<?php

namespace app\Invest\Entity;

/**
 * This is the model class for table "option".
 *
 * @property int $id
 * @property int $account_id
 * @property int $user_id
 * @property int $wallet_id
 * @property string $name
 * @property string $create_at
 * @property string $expiration_at
 * @property int $strike
 * @property int $price
 * @property int $count
 * @property int $type
 * @property float|null $comm_exchange
 * @property float|null $comm_broker
 * @property int|null $status
 */
class Option extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'opt';
    }


    public function rules()
    {
        return [
            [['account_id', 'user_id', 'wallet_id', 'create_at', 'expiration_at', 'strike', 'price', 'count', 'type'], 'required'],
            [['account_id', 'user_id', 'wallet_id', 'strike', 'price', 'count', 'type', 'status'], 'integer'],
            [['name'], 'string'],
            [['create_at', 'expiration_at'], 'safe'],
            [['comm_exchange', 'comm_broker'], 'number'],
        ];
    }

}
