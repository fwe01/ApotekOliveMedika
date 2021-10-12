<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    //return view('welcome');
});

Route::name('auth.')->group(function () {
	Route::get('admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
	Route::post('admin/login', [AuthController::class, 'authenticateAdmin'])->name('admin.login');
    Route::get('user/login', [AuthController::class, 'showUserLogin'])->name('user.login');
    Route::post('user/login', [AuthController::class, 'authenticateUser'])->name('user.login');
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
});
