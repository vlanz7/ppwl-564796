<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/program/create', [ProgramController::class, 'create'])->name('program.create');
    Route::post('/program',[ProgramController::class, 'store'])->name('program.store');
    Route::get('/program/{id}/edit', [ProgramController::class, 'edit'])->name('program.edit');
    Route::put('/program/{id}', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('/program/{id}',[ProgramController::class, 'destroy'])->name('program.destroy');
    Route::get('/program/search', [ProgramController::class, 'search'])->name('program.search');
});