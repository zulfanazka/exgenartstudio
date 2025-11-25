<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryAdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengajarController;
use App\Models\Pengajar;

// ----------------------
// 🌐 HALAMAN UTAMA (PUBLIC)
// ----------------------
Route::get('/', function () {
    $galleryEvent = File::files(public_path('images/event'));
    $galleryKarya = File::files(public_path('images/karya'));
    $pengajar = Pengajar::all();
    
    return view('welcome', compact('galleryEvent', 'galleryKarya', 'pengajar'));
})->name('home');

// =======================
// 🧍‍♂️ EVENT LOMBA (PUBLIC)
// =======================
Route::get('/lomba', [EventController::class, 'publicIndex'])->name('lomba');

// ----------------------
// 🔐 ADMIN AUTH ROUTES
// ----------------------
Route::prefix('admin')->group(function () {
    // Guest routes (login, register, forgot password)
    Route::middleware('guest')->group(function () {
        Volt::route('login', 'auth.login')->name('admin.login');
        Volt::route('register', 'auth.register')->name('admin.register');
        Volt::route('forgot-password', 'auth.forgot-password')->name('admin.password.request');
        Volt::route('reset-password/{token}', 'auth.reset-password')->name('admin.password.reset');
    });
    
    // Auth routes (verify email)
    Route::middleware('auth')->group(function () {
        Volt::route('verify-email', 'auth.verify-email')->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', App\Http\Controllers\Auth\VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
    });
    
    // Logout
    Route::post('logout', App\Livewire\Actions\Logout::class)->name('admin.logout');
    
    // Dashboard admin
    Route::get('/dashboard', [GalleryAdminController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
    
    // Settings admin
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
});

// ----------------------
// 🖼️ GALLERY KARYA ADMIN
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


// =======================
// 🧑‍💻 EVENT LOMBA ADMIN
// =======================
Route::prefix('admin/manage-event')->middleware('auth')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('admin.manageevent.index');
    Route::post('/store', [EventController::class, 'store'])->name('admin.manageevent.store');
    Route::delete('/{id}', [EventController::class, 'destroy'])->name('admin.manageevent.destroy');
    Route::put('/update/{id}', [EventController::class, 'update'])->name('admin.manageevent.update');
});

// =======================
// 🧑 Admin Pengajar
// =======================
Route::prefix('admin/pengajar')->middleware('auth')->group(function () {
    Route::get('/', [PengajarController::class, 'index'])->name('admin.pengajar.index');
    Route::get('/create', [PengajarController::class, 'create'])->name('admin.pengajar.create');
    Route::post('/store', [PengajarController::class, 'store'])->name('admin.pengajar.store');
    Route::get('/edit/{id}', [PengajarController::class, 'edit'])->name('admin.pengajar.edit');
    Route::put('/update/{id}', [PengajarController::class, 'update'])->name('admin.pengajar.update');
    Route::delete('/{id}', [PengajarController::class, 'destroy'])->name('admin.pengajar.destroy');
});

// ----------------------
// 🔗 ROUTE ALIAS for Fortify compatibility
// ----------------------
// Fortify's TwoFactorAuthenticatedSessionController needs route 'login' to exist
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');
