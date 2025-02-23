<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sekolah;
use App\Models\SekolahTahun;

class SekolahTahunPolicy
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
        return true; // Semua orang bisa lihat
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SekolahTahun $sekolahTahun): bool
    {
        return true; // Semua orang bisa lihat detail
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'admin_sekolah';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SekolahTahun $sekolahTahun): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'admin_sekolah') {
            return $user->sekolah_id === $sekolahTahun->sekolah_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SekolahTahun $sekolahTahun): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'admin_sekolah') {
            return $user->sekolah_id === $sekolahTahun->sekolah_id;
        }

        return false;
    }
}
