<?php

namespace app\User\Entity;

use app\Wallet\Entity\Wallet;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property User $user
 */
class Account extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'account';
    }


    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['status'], 'integer'],
        ];
    }


    public function getUsers()
    {
        return $this->hasMany(Profile::class, ['user_id' => 'id'])->viaTable('user', ['account_id' => 'id']);
    }


    public function getWallets()
    {
        return $this->hasMany(Wallet::class, ['user_id' => 'id'])->viaTable('user', ['account_id' => 'id']);
    }
}
