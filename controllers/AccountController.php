<?php

namespace app\controllers;

use app\Wallet\Factory\WalletFactory;
use app\Wallet\Repository\WalletRepository;
use Yii;

use app\User\Entity\User;
use app\Wallet\Entity\Wallet;

use app\User\Repository\AccountRepository;
use app\Wallet\Repository\TransactionRepository;

use yii\web\Controller;

class AccountController extends Controller
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


    public function actionAll()
    {
        $accountR = new AccountRepository();
        $account = $accountR->one(1, true);

        return ['account' => $account, 'users' => $account['users'], 'wallets' => $account['wallets']];
    }


    public function actionAddWallet()
    {
        $walletF = new WalletFactory();
        $walletF->create($this->user->id, 'Кошелек');

        $walletR = new WalletRepository();
        $wallets = $walletR->list($this->user->id, true);

        return ['wallets' => $wallets];
    }


    public function actionWallet()
    {
        $wallet = Wallet::find()->one();

        $transactionR = new TransactionRepository();
        return $transactionR->list($wallet->id, true);
    }


}
