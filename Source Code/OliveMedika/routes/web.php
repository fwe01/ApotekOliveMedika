<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\ResepController as AdminResepController;
use App\Http\Controllers\Admin\RestockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ResepController as UserResepController;
use App\Http\Controllers\User\UserBarangController;
use App\Http\Services\Pemesanan\CreatePemesanan\BarangPemesanan;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananRequest;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananService;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananRequest;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananService;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananRequest;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananService;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananRequest;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananService;
use App\Models\UserType;
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

	Route::prefix('accounts')->name('accounts.')->middleware('superadmin')->group(function () {
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

	Route::prefix('promo')->name('promos.')->group(function () {
		Route::get('index', [PromoController::class, 'index'])->name('index');
		Route::post('add', [PromoController::class, 'add'])->name('add');
		Route::post('delete', [PromoController::class, 'delete'])->name('delete');
		Route::post('update', [PromoController::class, 'update'])->name('update');
	});

	Route::prefix('pemesanan')->name('pemesanans.')->group(function () {
//		Route::get('index', [AdminResepController::class, 'index'])->name('index');
		Route::get('index', function () {
			/** @var ListPemesananService $service */
			$service = resolve(ListPemesananService::class);
			$response = $service->execute(
				new ListPemesananRequest(
					new UserType(UserType::ADMIN),
					1
				)
			);
			dd($response);
		})->name('index');
		Route::get('add', function () {
			/** @var CreatePemesananService $service */
			$service = resolve(CreatePemesananService::class);
			$service->execute(
				new CreatePemesananRequest(
					1,
					[
						new BarangPemesanan(
							1, 2
						),
						new BarangPemesanan(
							2, 5
						)
					]
				)
			);
		})->name('add');
//		Route::post('add', [AdminResepController::class, 'add'])->name('add');
//		Route::post('delete', [AdminResepController::class, 'delete'])->name('delete');
		Route::get('delete', function () {
			/** @var DeletePemesananService $service */
			$service = resolve(DeletePemesananService::class);
			$service->execute(
				new DeletePemesananRequest(
					1,
					new \App\Models\UserType(UserType::ADMIN),
					0
				)
			);
		})->name('delete');
		Route::get('find', function () {
			/** @var FindPemesananService $service */
			$service = resolve(FindPemesananService::class);
			$response = $service->execute(
				new FindPemesananRequest(
					2,
					new \App\Models\UserType(UserType::ADMIN),
					0
				)
			);
			dd($response);
		})->name('find');
	});

	Route::prefix('resep')->name('reseps.')->group(function () {
		Route::get('index', [AdminResepController::class, 'index'])->name('index');
//		Route::post('add', [AdminResepController::class, 'add'])->name('add');
//		Route::post('delete', [AdminResepController::class, 'delete'])->name('delete');
//		Route::post('update', [AdminResepController::class, 'update'])->name('update');
	});

	Route::prefix('restock')->name('restocks.')->group(function () {
		Route::get('index', [RestockController::class, 'index'])->name('index');
		Route::post('add', [RestockController::class, 'add'])->name('add');
//		Route::post('delete', [RestockController::class, 'delete'])->name('delete');
//		Route::post('update', [RestockController::class, 'update'])->name('update');
	});
});

Route::prefix('user')->name('user.')->middleware('user')->group(function () {
	Route::get('/', [HomeController::class, 'showHome'])->name('home');
	Route::get('/detil_barang/{id}', [UserBarangController::class, 'barangDetail'])->name('barangDetail');

	Route::prefix('resep')->name('reseps.')->group(function () {
//		Route::get('index', [ResepController::class, 'index'])->name('index');
		Route::get('create', function () {
			return view('user.resep.add');
		});
		Route::post('add', [UserResepController::class, 'add'])->name('add');
	});
});
