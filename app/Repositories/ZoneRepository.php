<?php
namespace App\Repositories;

use App\Zone;

class ZoneRepository extends Repository
{
    public function __construct(Zone $model)
    {
        parent::__construct($model);
    }
}