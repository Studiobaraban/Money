<?php

namespace app\controllers;

use Yii;

use app\User\Entity\User;
use app\Wallet\Entity\Wallet;

use app\Wallet\Factory\CategoryFactory;
use app\Wallet\Factory\GroupFactory;
use app\Wallet\Factory\TransactionFactory;
use app\Wallet\Factory\WalletFactory;

use app\Wallet\Repository\GroupRepository;
use app\Wallet\Repository\WalletRepository;

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
        $account = $accountR->one($this->user->account_id, true);

        $groupR = new GroupRepository();
        $groups = $groupR->list($this->user->account_id, true);

        $transactionR = new TransactionRepository();
        $transactions = $transactionR->list(null, true);

        return [
            'account' => $account,
            'users' => $account['users'],
            'wallets' => $account['wallets'],
            'groups' => $groups,
            'transactions' => $transactions
        ];
    }


    // добавить кошелек
    public function actionAddWallet()
    {
        $walletF = new WalletFactory();
        $walletF->create((int)$this->user->account_id, (int)$this->user->id, 'Кошелек');

        $walletR = new WalletRepository();
        $wallets = $walletR->account($this->user->account_id, true);

        return ['wallets' => $wallets];
    }


    // добавить группу
    public function actionAddGroup()
    {
        $post = Yii::$app->getRequest()->post();

        $groupF = new GroupFactory();
        $groupF->create($this->user->account_id, $post['name']);

        $groupR = new GroupRepository();
        $groups = $groupR->list($this->user->account_id, true);

        return ['groups' => $groups];
    }


    // добавить категорию
    public function actionAddCategory()
    {
        $post = Yii::$app->getRequest()->post();

        $categoryF = new CategoryFactory();
        $categoryF->create($this->user->account_id, $post['group_id'], $post['name']);

        $groupR = new GroupRepository();
        $groups = $groupR->list($this->user->account_id, true);

        return ['groups' => $groups];
    }


    // добавить категорию
    public function actionAddTransaction()
    {
        $post = Yii::$app->getRequest()->post();

        $wallet = Wallet::find()->where(['id' => $post['wallet_id']])->one(); // , 'user_id' => $this->user->id
        if (empty($wallet)) {
            return null;
        }

        $transactionF = new TransactionFactory();
        $transactionF->create($wallet, $post['category_id'], $post['sum'], (int)$post['type'], $post['description']);

        $transactionR = new TransactionRepository();
        $transactions = $transactionR->list(null, true);

        return ['transactions' => $transactions];
    }


    public function actionWallet()
    {
        $wallet = Wallet::find()->one();

        $transactionR = new TransactionRepository();
        return $transactionR->list($wallet->id, true);
    }


}
