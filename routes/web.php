<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;

// Public Pages
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Authentication
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/demo-login', [AuthController::class, 'demoLogin'])->name('demo.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
Route::get('/orlok', [DashboardController::class, 'orlokDashboard'])->name('orlok.dashboard');
Route::get('/verifikator', [DashboardController::class, 'verifikatorDashboard'])->name('verifikator.dashboard');
Route::get('/superadmin', [DashboardController::class, 'superadminDashboard'])->name('superadmin.dashboard');

// Pengajuan Routes
Route::prefix('/pengajuan')->name('pengajuan.')->group(function () {
    Route::get('/buat', [PengajuanController::class, 'create'])->name('create');
    Route::post('/', [PengajuanController::class, 'store'])->name('store');
    Route::get('/riwayat', [PengajuanController::class, 'history'])->name('history');
    Route::get('/daftar', [PengajuanController::class, 'list'])->name('list');
    Route::get('/semua', [PengajuanController::class, 'all'])->name('all');
    Route::get('/verifikasi', [PengajuanController::class, 'verify'])->name('verify');
    Route::post('/verifikasi', [PengajuanController::class, 'submitVerification'])->name('submit.verify');
});

// User Management
Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

// Settings
Route::prefix('/settings')->name('settings.')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/update', [SettingController::class, 'update'])->name('update');
    Route::post('/email', [SettingController::class, 'updateEmail'])->name('email.update');
});

Route::get('/settings', [SettingController::class, 'index'])->name('settings');

// 404 Fallback
Route::fallback([PageController::class, 'notFound']);
