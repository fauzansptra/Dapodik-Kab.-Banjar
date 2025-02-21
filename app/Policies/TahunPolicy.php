<?php

namespace App\Policies;

use App\Models\User;
use App\models\Tahun;

class TahunPolicy
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
        return true; // semua boleh lihat
    }

    public function view(User $user, Tahun $tahun)
    {
        return true;
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
