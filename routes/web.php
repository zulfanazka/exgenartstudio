<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryAdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengajarController;
use App\Models\Pengajar;

// ----------------------
// 🌐 HALAMAN UTAMA
// ----------------------
Route::get('/', function () {
    $galleryEvent = File::files(public_path('images/event'));
    $galleryKarya = File::files(public_path('images/karya'));
    $pengajar = Pengajar::all();
    
    return view('welcome', compact('galleryEvent', 'galleryKarya', 'pengajar'));
})->name('home');

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

// =======================
// 🧍‍♂️ EVENT LOMBA USER
// =======================
Route::get('/lomba', [EventController::class, 'publicIndex'])->name('lomba');

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
