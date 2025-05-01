<?php

namespace App\Policies;

use App\Models\User;

class DiscussionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return true;
    }
}
