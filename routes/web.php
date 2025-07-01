<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesantrenController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Kategori routes
    Route::resource('kategori', KategoriController::class);

    // Aset routes
    Route::resource('aset', AsetController::class);

    // Maintenance routes
    Route::resource('maintenance', MaintenanceController::class);

    // Laporan routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/aset', [LaporanController::class, 'aset'])->name('laporan.aset');
    Route::get('/laporan/maintenance', [LaporanController::class, 'maintenance'])->name('laporan.maintenance');
    Route::get('/laporan/kategori', [LaporanController::class, 'kategori'])->name('laporan.kategori');
    Route::post('/laporan/export-aset', [LaporanController::class, 'exportAset'])->name('laporan.export-aset');

    // User routes
    Route::resource('user', UserController::class);
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.update-profile');

    // Pesantren routes
    Route::get('/pesantren', [PesantrenController::class, 'index'])->name('pesantren.index');
    Route::get('/pesantren/edit', [PesantrenController::class, 'edit'])->name('pesantren.edit');
    Route::put('/pesantren', [PesantrenController::class, 'update'])->name('pesantren.update');

    // Backup routes
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup', [BackupController::class, 'create'])->name('backup.create');
    Route::get('/backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
    Route::delete('/backup/{filename}', [BackupController::class, 'delete'])->name('backup.delete');
    Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore');

    // Additional routes for specific categories
    Route::get('/bangunan', [AsetController::class, 'index'])->name('bangunan')->defaults('kategori', 'bangunan');
    Route::get('/peralatan', [AsetController::class, 'index'])->name('peralatan')->defaults('kategori', 'peralatan');
    Route::get('/buku', [AsetController::class, 'index'])->name('buku')->defaults('kategori', 'buku');
    Route::get('/kendaraan', [AsetController::class, 'index'])->name('kendaraan')->defaults('kategori', 'kendaraan');
    Route::get('/elektronik', [AsetController::class, 'index'])->name('elektronik')->defaults('kategori', 'elektronik');
    Route::get('/pakaian', [AsetController::class, 'index'])->name('pakaian')->defaults('kategori', 'pakaian');
});
