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
        if ($user->id === 1) {
            return true;
        } else {
            return $user->id === $item->user_id;
        }
    }
}
