<?php
namespace App\Repositories;

use App\Variable;

class VariableRepository extends Repository
{
    public function __construct(Variable $model)
    {
        parent::__construct($model);
    }
}