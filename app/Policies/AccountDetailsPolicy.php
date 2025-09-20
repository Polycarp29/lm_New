<?php

namespace App\Policies;

use App\Models\User;

class AccountDetailsPolicy
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
        return $user->hasAnyRole(['super_admin', 'admin', 'accountant']);
    }
}
