<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

// Progress
Route::get('/progress-wakaf', [ProgressController::class, 'index'])->name('progress.index');

// Kelas CRUD
Route::resource('kelas', KelasController::class);

// Siswa CRUD + Import/Template
Route::get('/siswa/template', [SiswaController::class, 'downloadTemplate'])->name('siswa.template');
Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::get('/siswa/pewakaf', [App\Http\Controllers\SiswaController::class, 'pewakaf'])->name('siswa.pewakaf');
Route::get('/siswa/{id}/riwayat', [App\Http\Controllers\SiswaController::class, 'riwayat'])->name('siswa.riwayat');
Route::resource('siswa', SiswaController::class);
