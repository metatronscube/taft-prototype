<?php

namespace App\Policies;

use App\User;
use App\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy extends Policy
{
    use HandlesAuthorization;

    public function __construct(Item $model)
    {
        parent::__construct($model);
    }
}
