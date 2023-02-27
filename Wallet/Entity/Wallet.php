<?php

namespace app\Wallet\Entity;


use yii\db\Transaction;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $currency
 * @property float $balance
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
            [['user_id', 'name'], 'required'],
            [['id', 'user_id', 'status'], 'integer'],
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
}
