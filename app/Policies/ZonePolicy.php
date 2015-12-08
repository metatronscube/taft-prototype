<?php

namespace App\Policies;

use App\User;
use App\Zone;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZonePolicy extends Policy
{
    use HandlesAuthorization;

    public function __construct(Zone $model)
    {
        parent::__construct($model);
    }
}
