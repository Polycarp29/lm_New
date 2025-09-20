<?php

namespace App\Policies;

use App\Models\User;

class AboutUsBannerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }
}
