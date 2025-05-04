<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Discussion;

class DiscussionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return true;
    }
    public function reply(User $user, Discussion $discussion)
    {
        return true;
    }
}
