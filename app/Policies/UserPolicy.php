<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
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
        if ($user->role === 'superadmin') {
            return true;
        }

        return false; // semua boleh lihat
    }

    public function view(User $user)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        return false;
    }

    public function create(User $user)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        return false;
    }

    public function update(User $user)
    {
        if ($user->role === 'superadmin') {
            return true;
        }
        return false;
    }

    public function delete(User $user)
    {
        if ($user->role === 'superadmin') {
            return true;
        }
        return false;
    }
}
