<?php
 
namespace App\Http\Responses;
 
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // Jika user adalah admin sekolah, redirect ke halaman detail sekolah
        if ($user->role === 'admin_sekolah') {
            return redirect()->route('filament.admin.resources.sekolahs.view', ['record' => $user->sekolah_id]);
        }

        // Default redirect jika bukan admin sekolah
        return redirect()->intended(Filament::getHomeUrl());
    }
}