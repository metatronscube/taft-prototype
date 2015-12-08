<?php

namespace App\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

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
     * Determine if the given user can delete the given model.
     *
     * @param  User  $user
     * @param  Model $model
     * @return bool
     */
    public function destroy(User $user, Model $model)
    {
        if ($user->id === 1) {
            return true;
        } else {
            return $user->id === $model->user_id;
        }
    }
}
