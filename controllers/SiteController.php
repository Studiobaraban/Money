<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{

    public $enableCsrfValidation = false;


    public function actionIndex()
    {
        return 'Money';
    }

}
