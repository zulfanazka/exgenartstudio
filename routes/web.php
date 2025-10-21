<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    $galleryEvent = File::files(public_path('images/event'));
    $galleryKarya = File::files(public_path('images/karya'));
    
    return view('welcome', compact('galleryEvent', 'galleryKarya'));
})->name('home');

Route::get('/lomba', function () {
    return view('lomba');
})->name('lomba');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');