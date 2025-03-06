<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kecamatan;

class KecamatanPolicy
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

    public function view(User $user)
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
