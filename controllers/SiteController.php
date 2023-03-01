<?php

namespace app\controllers;

use Yii;

use app\User\Entity\User;

use yii\web\Controller;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }


    // Вход
    public function actionLogin()
    {
        $post = Yii::$app->getRequest()->post();

        if (empty($post['username']) && empty($post['password'])) {
            return ['alert' => ['msg' => 'Введите пароль', 'type' => 'error']];
        }

        $user = User::find()->where(['user.username' => $post['username'], 'user.status' => 10])->joinWith('profile')->one();

//        $user->password_hash = Yii::$app->security->generatePasswordHash('5378h4gv');

        if (!empty($user) && $user->validatePassword($post['password'], $user->password_hash)) {

            $token = Yii::$app->security->generateRandomString(24);
            $user->token = $token;
            $user->save();

            return ['token' => $token, 'profile' => $user->profile];
        }

        return ['alert' => ['msg' => 'Не верный логин или пароль', 'type' => 'error']];
    }

}
