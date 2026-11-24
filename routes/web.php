<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\GaleriProgramController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DetailPembayaranController;
use Illuminate\Support\Facades\Mail;

Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/program/search', [ProgramController::class, 'search'])->name('program.search');
    Route::get('/galeri', [GaleriProgramController::class, 'index'])->name('galeri.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');

    Route::middleware('admin')->group(function () {
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('/program/create', [ProgramController::class, 'create'])->name('program.create');
        Route::post('/program', [ProgramController::class, 'store'])->name('program.store');
        Route::get('/program/{id}/edit', [ProgramController::class, 'edit'])->name('program.edit');
        Route::put('/program/{id}', [ProgramController::class, 'update'])->name('program.update');
        Route::delete('/program/{id}', [ProgramController::class, 'destroy'])->name('program.destroy');
        // Pengelolaan akun Admin
        Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        // Pengelolaan galeri
        Route::get('/galeri/create', [GaleriProgramController::class, 'create'])->name('galeri.create');
        Route::post('/galeri', [GaleriProgramController::class, 'store'])->name('galeri.store');
        Route::get('/galeri/{id}/edit', [GaleriProgramController::class, 'edit'])->name('galeri.edit');
        Route::put('/galeri/{id}', [GaleriProgramController::class, 'update'])->name('galeri.update');
        Route::delete('/galeri/{id}', [GaleriProgramController::class, 'destroy'])->name('galeri.destroy');
    });
});