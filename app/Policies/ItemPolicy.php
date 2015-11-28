<?php

namespace App\Policies;

use App\User;
use App\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given item.
     *
     * @param  User  $user
     * @param  Item  $item
     * @return bool
     */
    public function destroy(User $user, Item $item)
    {
        return $user->id === $item->user_id;
    }
}
