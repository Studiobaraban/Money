<?php

namespace app\Wallet\Entity;


use app\User\Entity\Account;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property int $account_id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $currency
 * @property float $balance
 * @property int $type              1 деньги, 2 бизнес, 3 инвестиции
 * @property int $status
 *
 */
class Wallet extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'wallet';
    }


    public function rules()
    {
        return [
            [['account_id', 'user_id', 'name'], 'required'],
            [['id', 'account_id', 'user_id', 'type', 'status'], 'integer'],
            [['name', 'description', 'currency'], 'string'],
            [['balance'], 'number']
        ];
    }


    // изменить баланс на сумму $sum
    public function changeBalance(float $sum): void
    {
        $this->balance = $this->balance + $sum;
        $this->save();
    }


    public function getTransactions()
    {
        return $this->hasMany(Transaction::class, ['wallet_id' => 'id']);
    }

    public function getAccount()
    {
        return $this->hasOne(Account::class, ['id' => 'account_id']);
    }
}
