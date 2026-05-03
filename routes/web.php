<?php

// use App\Http\Controllers\Backend\AppLogController;
// use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\backend\BannerControler;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DownloadControler;
use App\Http\Controllers\backend\FieldControler;
use App\Http\Controllers\backend\GalleryControler;
use App\Http\Controllers\backend\IdentityControler;
use App\Http\Controllers\backend\NewsControler;
use App\Http\Controllers\backend\StructureOrganizationControler;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// == Frontend Routes ==
Route::get('/', [MainController::class, 'index'])->name('main.index');

// Route::get('/admin/dashboard', [DashboardController::class, 'index'])
//         ->middleware(['auth', 'verified'])
//         ->name('dashboard');

Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
        # Dashboard
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        # Identitas Website
        Route::prefix('/admin/identitas-website')->name('identity.')->group(function () {
                Route::get('/',             [IdentityControler::class, 'index'])->name('index');
                Route::post('/',            [IdentityControler::class, 'store'])->name('store');
                Route::delete('/{key}',     [IdentityControler::class, 'destroy'])->name('destroy');
        });

        # Struktur Organisasi
        Route::get('/admin/struktur-organisasi', [StructureOrganizationControler::class, 'index'])->name('structure-organization.index');
        Route::resource('/admin/struktur-organisasi', StructureOrganizationControler::class)
                ->except(['index']);

        # Berita
        Route::get('/admin/berita', [NewsControler::class, 'index'])->name('news.index');
        Route::resource('/admin/berita', NewsControler::class)->except(['index']);

        # Galeri
        Route::get('/admin/galeri', [GalleryControler::class, 'index'])->name('gallery.index');
        Route::resource('/admin/galeri', GalleryControler::class)->except(['index']);

        # Unduhan
        Route::get('/admin/unduhan', [DownloadControler::class, 'index'])
                ->name('download.index');
        Route::resource('/admin/unduhan', DownloadControler::class)
                ->except(['index']);
        Route::get('download-file/{media}', [DownloadControler::class, 'downloadFile'])
                ->name('download.file');

        # Bidang
        Route::get('/admin/bidang', [FieldControler::class, 'index'])
                ->name('field.index');
        Route::resource('/admin/bidang', FieldControler::class)
                ->except(['index']);

        # Banner
        Route::get('/admin/banner', [BannerControler::class, 'index'])->name('banner.index');
        Route::resource('/admin/banner', BannerControler::class)->except(['index']);
});

require __DIR__ . '/auth.php';
