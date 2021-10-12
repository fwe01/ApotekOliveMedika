<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Admin\CreateAdmin\CreateAdminRequest;
use App\Http\Services\Admin\CreateAdmin\CreateAdminService;
use App\Http\Services\Admin\DeleteAdmin\DeleteAdminRequest;
use App\Http\Services\Admin\DeleteAdmin\DeleteAdminService;
use App\Http\Services\Admin\ListAdmin\ListAdminService;
use App\Http\Services\Admin\UpdateAdmin\UpdateAdminRequest;
use App\Http\Services\Admin\UpdateAdmin\UpdateAdminService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController
{
	public function index()
	{
		$this->ensureIsSuperadmin();
		/** @var ListAdminService $service */
		$service = resolve(ListAdminService::class);
		$admins = $service->execute();
		return view('admin.accounts.index', compact('admins'));
	}

	public function ensureIsSuperadmin()
	{
		if (Auth::guard('admin')->user()->username !== 'superadmin') {
			return redirect()->back();
		}
		return 0;
	}

	public function add(Request $request)
	{
		$this->ensureIsSuperadmin();
		$request->validate(
			[
				'nama' => 'required',
				'username' => 'required|unique:admins,username',
				'no_telp' => 'required',
				'alamat' => 'required',
				'password' => 'required|confirmed',
			]
		);

		$input = new CreateAdminRequest(
			$request->input('nama'),
			$request->input('alamat'),
			$request->input('no_telp'),
			$request->input('username'),
			$request->input('password'),
		);

		/** @var CreateAdminService $service */
		$service = resolve(CreateAdminService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal membuat admin');
		}
		return redirect()->back()->with('success', 'Admin berhasil dibuat');
	}

	public function update(Request $request)
	{
		$this->ensureIsSuperadmin();
		$request->validate(
			[
				'id' => 'required',
				'nama' => 'required',
				'no_telp' => 'required',
				'alamat' => 'required',
			]
		);

		if ($request->input('password')) {
			$request->validate(
				[
					'password' => 'confirmed'
				]
			);
		}

		$input = new UpdateAdminRequest(
			$request->input('id'),
			$request->input('nama'),
			$request->input('alamat'),
			$request->input('no_telp'),
			$request->input('password'),
		);

		/** @var UpdateAdminService $service */
		$service = resolve(UpdateAdminService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			if ($e instanceof OliveMedikaException && $e->getCode() === 2001) {
				return redirect()->back()->with('alert', 'Admin tidak ditemukan');
			}
			return redirect()->back()->with('alert', 'Gagal mengupdate admin');
		}
		return redirect()->back()->with('success', 'Admin berhasil diupdate');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function delete(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new DeleteAdminRequest($request->input('id'));

		/** @var DeleteAdminService $service */
		$service = resolve(DeleteAdminService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			if ($e instanceof OliveMedikaException && $e->getCode() === 2004) {
				return redirect()->back()->with('alert', 'Admin tidak ditemukan');
			}
			return redirect()->back()->with('alert', 'Gagal menghapus admin');
		}
		return redirect()->back()->with('success', 'Admin berhasil dihapus');
	}
}