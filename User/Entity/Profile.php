<?php

namespace app\User\Entity;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property int $sex
 * @property string $name
 * @property string $secondname
 * @property string $middlename
 * @property string $email
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $bday
 * @property string $vk
 * @property string $fb
 * @property string $tl
 * @property string $picture
 * @property string $create_at
 * @property int $status
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'profile';
    }


    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'sex', 'status'], 'integer'],
            [['bday', 'create_at'], 'safe'],
            [['name', 'secondname', 'middlename', 'email', 'phone', 'country', 'city', 'vk', 'fb', 'tw', 'tl', 'in', 'picture'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}