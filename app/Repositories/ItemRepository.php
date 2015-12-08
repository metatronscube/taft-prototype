<?php
namespace App\Repositories;

use App\Item;

class ItemRepository extends Repository
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }
}