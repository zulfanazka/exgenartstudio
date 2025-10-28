<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryAdminController;
use App\Http\Controllers\EventController;

// ----------------------
// 🌐 HALAMAN UTAMA
// ----------------------
Route::get('/', function () {
    $galleryEvent = File::files(public_path('images/event'));
    $galleryKarya = File::files(public_path('images/karya'));
    
    return view('welcome', compact('galleryEvent', 'galleryKarya'));
})->name('home');

Route::get('/lomba', function () {
    return view('lomba');
})->name('lomba');

// ----------------------
// 🧑‍💻 DASHBOARD USER
// ----------------------
Route::get('/dashboard', [GalleryAdminController::class, 'index'])
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

// ----------------------
// 🎨 GALLERY USER
// ----------------------
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// ----------------------
// 🖼️ GALLERY ADMIN
// ----------------------
Route::prefix('admin/gallery')->middleware('auth')->group(function () {
    Route::get('/', [GalleryAdminController::class, 'index'])->name('admin.gallery.index');
    Route::post('/store', [GalleryAdminController::class, 'storeGallery'])->name('gallery.store');
    Route::delete('/{id}', [GalleryAdminController::class, 'deleteGallery'])->name('gallery.delete');
    Route::put('/update/{id}', [GalleryAdminController::class, 'updateGallery'])->name('gallery.update');
});

// ----------------------
// 🎉 GALLERY EVENT ADMIN
// ----------------------
Route::prefix('admin/event')->middleware('auth')->group(function () {
    Route::get('/', [GalleryAdminController::class, 'index'])->name('admin.event.index');
    Route::post('/store', [GalleryAdminController::class, 'storeEvent'])->name('event.store');
    Route::delete('/{id}', [GalleryAdminController::class, 'deleteEvent'])->name('event.delete');
    Route::put('/update/{id}', [GalleryAdminController::class, 'updateEvent'])->name('event.update');
});

