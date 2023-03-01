<?php

namespace app\controllers;

use Yii;
use app\User\Entity\User;

use yii\web\Controller;

class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }

    private $_user;

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByHeaders(Yii::$app->request->headers);
        }
        return $this->_user;
    }


    public function actionProfile()
    {
        if (empty($this->user)) {
            return ['alert' => ['msg' => 'Вы не авторизованы', 'type' => 'error']];
        }
        return ['menu' => null, 'profile' => $this->user->profile];
    }


    public function actionTest()
    {
        return ['menu' => 123];
    }


}