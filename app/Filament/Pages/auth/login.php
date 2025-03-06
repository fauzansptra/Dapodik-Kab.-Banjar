<?php 

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends BaseLogin
{

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
            \Filament\Actions\Action::make('guestLogin')
            ->label('Masuk Sebagai Tamu')
            ->icon('heroicon-s-user')
            ->color('info')
            ->action(fn() => $this->authenticateGuest())
        ];
    }

    protected function authenticateGuest()
    {
        $guestUser = User::firstOrCreate(
            ['email' => 'guest@example.com'],
            [
                'name' => 'Guest User',
                'password' => bcrypt('password'),
                'role' => 'guest',
            ]
        );

        Auth::login($guestUser);

        redirect()->route('filament.admin.pages.dashboard');
    }
}
