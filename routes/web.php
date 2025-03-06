<?php

use Filament\Facades\Filament;
use Filament\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

// Route::middleware('web')->group(base_path('routes/filament.php'));