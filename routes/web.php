<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->middleware('islogin')->group(function() {
    Route::get('/login', [AuthController::class, 'login_page'])->name('login_page');
    Route::post('/login', [AuthController::class, 'login_submit'])->name('login');
});

Route::prefix('admin')->middleware('admin')->group(function(){

    // Route untuk Dashboard Admin
    Route::get('dashboard', function(){
        $guru = session('guru');

        return view('admin.dashboard', compact('guru'));
    })->name('admin.dashboard');

    Route::prefix('siswa')->group( function() {
        Route::prefix('siswa')->group(function () {
        // <-- ISI ROUTE SISWA DI SINI -->
        Route::get('/', [SiswaController::class, 'daftar_siswa_page'])->name('siswa.daftar-siswa-page');
        Route::get('tambah', [SiswaController::class, 'tambah_siswa_page'])->name('siswa.tambah-siswa-page');
        Route::post('tambah', [SiswaController::class, 'tambah_siswa'])->name('siswa.tambah-siswa');
        Route::get('{id}/edit', [SiswaController::class, 'edit_siswa_page'])->name('siswa.edit-siswa-page');
        Route::put('{id}/edit', [SiswaController::class, 'edit_siswa'])->name('siswa.edit-siswa');
        Route::delete('{id}/delete', [SiswaController::class, 'hapus_siswa'])->name('siswa.delete-siswa');
    });
    });

    Route::prefix('guru')->group( function() {
         // Halaman Daftar Guru
        Route::get('/', [GuruController::class, 'daftar_guru_page'])->name('guru.daftar-guru-page');
        // Halaman Tambah Guru
        Route::get('tambah', [GuruController::class, 'tambah_guru_page'])->name('guru.tambah-guru-page');
        // Logic Simpan Guru
        Route::post('tambah', [GuruController::class, 'tambah_guru'])->name('guru.tambah-guru');
        // Halaman Edit Guru
        Route::get('{id}/edit', [GuruController::class, 'edit_guru_page'])->name('guru.edit-guru-page');
        // Logic Update Guru
        Route::put('{id}/edit', [GuruController::class, 'edit_guru'])->name('guru.edit-guru'); // Pakai PUT untuk update
        // Logic Delete Guru
        Route::delete('{id}/delete', [GuruController::class, 'delete_guru'])->name('guru.delete-guru'); // Pakai DELETE
    });
});
