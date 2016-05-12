<?php
namespace App\Repositories;

use App\Action;

class ActionRepository extends Repository
{
    public function __construct(Action $model)
    {
        parent::__construct($model);
    }
}