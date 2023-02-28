<?php

namespace app\User\Factory;

use app\User\Entity\Account;

class AccountFactory
{
    public function create(string $name = null): Account
    {
        $account = new Account();
        $account->name = $name;
        $account->status = 1;
        $account->save();

        return $account;
    }


}
