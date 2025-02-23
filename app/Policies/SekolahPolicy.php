<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sekolah;

class SekolahPolicy
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

    public function view(User $user, Sekolah $sekolah)
    {
        return true;
    }

    public function create(User $user, Sekolah $sekolah)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        if ($user->role === 'admin_sekolah') {
            return $user->id === $sekolah->user_id;
        }

        return false;
    }

    public function update(User $user, Sekolah $sekolah)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        if ($user->role === 'admin_sekolah') {
            return $user->id === $sekolah->user_id;
        }

        return false;
    }

    public function delete(User $user, Sekolah $sekolah)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        if ($user->role === 'admin_sekolah') {
            return $user->id === $sekolah->user_id;
        }

        return false;
    }
}
