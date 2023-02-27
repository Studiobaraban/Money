<?php

namespace app\Wallet;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'app\Wallet\Controllers';


    public $layout = '/main';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
