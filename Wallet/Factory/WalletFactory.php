<?php

namespace app\Wallet\Factory;

use app\Wallet\Entity\Wallet;

class WalletFactory
{
    public function create(int $user_id, string $name, string $description = null): Wallet
    {
        $wallet = new Wallet();
        $wallet->user_id = $user_id;
        $wallet->name = $name;
        $wallet->description = $description;
        $wallet->status = 1;
        $wallet->save();

        return $wallet;
    }


}
