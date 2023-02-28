<?php

namespace app\Wallet\Entity;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property int $account_id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property int $del
 *
 */
class Group extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'group';
    }


    public function rules()
    {
        return [
            [['account_id', 'name'], 'required'],
            [['id', 'account_id', 'status', 'del'], 'integer'],
            [['name', 'description'], 'string'],
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['group_id' => 'id']);
    }


}
