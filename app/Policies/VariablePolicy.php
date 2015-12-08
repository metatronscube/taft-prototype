<?php

namespace App\Policies;

use App\User;
use App\Variable;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariablePolicy extends Policy
{
    use HandlesAuthorization;

    public function __construct(Variable $model)
    {
        parent::__construct($model);
    }
}
