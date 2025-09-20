<?php

namespace App\Policies;

use App\Models\User;

class UpperAboutSection
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
        return $user->hasAnyRole(['super_admin', 'admin']);
    }
}
