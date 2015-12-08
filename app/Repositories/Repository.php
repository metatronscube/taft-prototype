<?php
namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     * @param  Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all of the {model}s for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $this->model->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function forAdmin()
    {
        return $this->model->all();
        //->orderBy('created_at', 'asc')
    }
}