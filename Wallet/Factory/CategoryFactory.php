<?php

namespace app\Wallet\Factory;

use app\Wallet\Entity\Category;

class CategoryFactory
{
    public function create(int $account_id, int $group_id, string $name, string $description = null): Category
    {
        $category = new Category();
        $category->account_id = $account_id;
        $category->group_id = $group_id;
        $category->name = $name;
        $category->description = $description;
        $category->status = 1;
        $category->del = 0;
        $category->save();

        return $category;
    }


}
