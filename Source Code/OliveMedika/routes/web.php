<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'showUserLogin'])->name('user.login');

Route::name('auth.')->group(function () {
    Route::get('admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('admin/login', [AuthController::class, 'authenticateAdmin'])->name('admin.login');
    Route::get('login', [AuthController::class, 'showUserLogin'])->name('user.login');
    Route::post('login', [AuthController::class, 'authenticateUser'])->name('user.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::get('index', [AccountsController::class, 'index'])->name('index');
        Route::post('add', [AccountsController::class, 'add'])->name('add');
        Route::post('update', [AccountsController::class, 'update'])->name('update');
        Route::post('delete', [AccountsController::class, 'delete'])->name('delete');
    });

    Route::prefix('barang')->name('barangs.')->group(function () {
        Route::get('index', [BarangController::class, 'index'])->name('index');
        Route::post('add', [BarangController::class, 'add'])->name('add');
        Route::post('delete', [BarangController::class, 'delete'])->name('delete');
        Route::post('update', [BarangController::class, 'update'])->name('update');
    });
});

Route::prefix('user')->name('user.')->middleware('user')->group(function () {
    Route::get('/', [HomeController::class, 'showHome'])->name('home');
});
