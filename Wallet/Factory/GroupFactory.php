<?php

namespace app\Wallet\Factory;

use app\Wallet\Entity\Group;

class GroupFactory
{
    public function create(int $account_id, string $name, string $description = null): Group
    {
        $group = new Group();
        $group->account_id = $account_id;
        $group->name = $name;
        $group->description = $description;
        $group->status = 1;
        $group->del = 0;
        $group->save();

        return $group;
    }


}
