<?php

namespace app\User\Entity;

use app\User\Entity\User;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property int $user_id
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
            [['user_id', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
