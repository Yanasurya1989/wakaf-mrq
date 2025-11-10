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
// CRUD Riwayat Setoran
Route::prefix('siswa/{siswa_id}/setoran')->group(function () {
    Route::get('/', [App\Http\Controllers\SetoranController::class, 'index'])->name('setoran.index');
    Route::get('/create', [App\Http\Controllers\SetoranController::class, 'create'])->name('setoran.create');
    Route::post('/', [App\Http\Controllers\SetoranController::class, 'store'])->name('setoran.store');
});

Route::get('/setoran/{id}/edit', [App\Http\Controllers\SetoranController::class, 'edit'])->name('setoran.edit');
Route::put('/setoran/{id}', [App\Http\Controllers\SetoranController::class, 'update'])->name('setoran.update');
Route::delete('/setoran/{id}', [App\Http\Controllers\SetoranController::class, 'destroy'])->name('setoran.destroy');

Route::get('/siswa/{id}/riwayat', [App\Http\Controllers\SiswaController::class, 'riwayat'])->name('siswa.riwayat');
Route::resource('siswa', SiswaController::class);

Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
