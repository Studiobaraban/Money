<?php

namespace app\User\Entity;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $account_id
 * @property string $roles
 * @property string $token
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    public static function tableName()
    {
        return 'user';
    }


    public function rules()
    {
        return [
            [['account_id', 'username', 'password_hash'], 'required'],
            [['account_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['roles', 'token', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
        ];
    }


    public static function findByHeaders($headers)
    {
//        return User::findOne(['id' => 7]);

        $auth = $headers->get('Authorization');
        if (empty($auth)) {
             return null;
        }

        $token = str_replace('Bearer ', '', $auth);
        if (empty($token)) {
            return null;
        }

        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return null;
        }

        Yii::$app->user->login($user);
        return $user;
    }


    public function validatePassword($password, $hash)
    {
        return Yii::$app->security->validatePassword($password, $hash);
    }


    public static function setPassword($password, $user)
    {
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        if (!$user->save()) {
            return null;
        }
        return $user;
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->where(['user.token' => $token, 'user.status' => 10])->joinWith('profile')->one();
    }


    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }


    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }
}
