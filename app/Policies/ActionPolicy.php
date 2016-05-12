<?php

namespace App\Policies;

use App\User;
use App\Action;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPolicy extends Policy
{
    use HandlesAuthorization;

    public function __construct(Action $model)
    {
        parent::__construct($model);
    }
}
