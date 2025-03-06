<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class tambahan extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Lainnya';
    public static function shouldRegisterNavigation(): bool
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (! in_array($user->role,['superadmin','guest'])) {
            return false;
        }
        return static::canAccessClusteredComponents();
    }
}
