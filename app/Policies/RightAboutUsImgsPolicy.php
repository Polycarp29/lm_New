<?php

namespace App\Policies;

use App\Models\User;

class RightAboutUsImgsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin');
    }
}
