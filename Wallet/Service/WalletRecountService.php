<?php

namespace app\Wallet\Service;

use app\Wallet\Entity\Wallet;

class WalletRecountService
{
    public static function handle(int $account_id, ?int $wallet_ids): void
    {
        $wallets = Wallet::find()->where(['wallet.account_id' => $account_id, 'wallet.status' => 1, 'wallet.type' => 1])->andFilterWhere(['wallet.id' => $wallet_ids])->joinWith('transactions')->all();

        if (!empty($wallets)) {
            foreach ($wallets as $wallet) {
                $balance = 0;
                foreach ($wallet->transactions as $transaction) {
                    $balance += $transaction->sum;
                }
                $wallet->balance = $balance;
                $wallet->save();
            }
        }
    }

}