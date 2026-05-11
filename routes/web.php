<?php

// use App\Http\Controllers\Backend\AppLogController;
// use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\backend\BannerControler;
use App\Http\Controllers\backend\CasesController as BackendCasesController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DownloadControler;
use App\Http\Controllers\backend\FieldControler;
use App\Http\Controllers\backend\GalleryControler;
use App\Http\Controllers\backend\IdentityControler;
use App\Http\Controllers\backend\NewsControler;
use App\Http\Controllers\backend\RequestsController as BackendRequestsController;
use App\Http\Controllers\backend\StructureOrganizationControler;
use App\Http\Controllers\frontend\CasesController;
use App\Http\Controllers\frontend\CctvController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\DownloadController;
use App\Http\Controllers\frontend\GalleryController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\RequestsController;
use App\Http\Controllers\frontend\StructureOrganizationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// == Frontend Routes ==
// Dashboard
Route::get('/', [MainController::class, 'index'])->name('main.index');

// Berita
Route::get('/berita', [NewsController::class, 'index'])->name('frontend.news.index');
Route::get('/berita/{id}', [NewsController::class, 'show'])->name('frontend.news.show');

// Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('frontend.gallery.index');

// Struktur Organisasi
Route::get('/struktur-organisasi', [StructureOrganizationController::class, 'index'])->name('frontend.structure-organization.index');
// Bidang
Route::get('/bidang/{id}', [StructureOrganizationController::class, 'showByField'])->name('frontend.field.show');

// Unduhan
Route::get('/unduhan', [DownloadController::class, 'index'])->name('frontend.download.index');
Route::get('/unduhan/file/{media}', [DownloadControler::class, 'downloadFile'])->name('download.file');

// Hubungi Kami
Route::get('/hubungi-kami', [ContactController::class, 'index'])->name('frontend.contact.index');
Route::post('/hubungi-kami', [ContactController::class, 'store'])->name('frontend.contact.store');

// Pegajuan
Route::get('/pengajuan', [RequestsController::class, 'index'])->name('frontend.requests.index');
Route::post('/pengajuan', [RequestsController::class, 'store'])->name('frontend.requests.store');
Route::get('/pengajuan/cari', [RequestsController::class, 'track'])->name('frontend.requests.track');
Route::get('/pengajuan/{id}', [RequestsController::class, 'show'])->name('frontend.requests.show');

// Keluhan
Route::get('/keluhan', [CasesController::class, 'index'])->name('frontend.cases.index');
Route::post('/keluhan', [CasesController::class, 'store'])->name('frontend.cases.store');
Route::get('/keluhan/cari', [CasesController::class, 'track'])->name('frontend.cases.track');
Route::get('/keluhan/{id}', [CasesController::class, 'show'])->name('frontend.cases.show');

// CCTV
Route::get('/cctv', [CctvController::class, 'index'])->name('frontend.cctv.index');

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

        # Pengajuan
        Route::get('/admin/pengajuan', [BackendRequestsController::class, 'index'])->name('requests.index');
        Route::get('/admin/pengajuan/{id}', [BackendRequestsController::class, 'show'])->name('requests.show');
        Route::put('/admin/pengajuan/{id}', [BackendRequestsController::class, 'update'])->name('requests.update');
        Route::delete('/admin/pengajuan/{id}', [BackendRequestsController::class, 'destroy'])->name('requests.destroy');

        # Keluhan
        Route::get('/admin/keluhan', [BackendCasesController::class, 'index'])->name('cases.index');
        Route::get('/admin/keluhan/{id}', [BackendCasesController::class, 'show'])->name('cases.show');
        Route::put('/admin/keluhan/{id}', [BackendCasesController::class, 'update'])->name('cases.update');
        Route::delete('/admin/keluhan/{id}', [BackendCasesController::class, 'destroy'])->name('cases.destroy');
});

require __DIR__ . '/auth.php';
