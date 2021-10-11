<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\AdminLogin\AdminLoginRequest;
use App\Http\Services\Admin\AdminLogin\AdminLoginService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
	public function showAdminLogin()
	{
		return view('auth.admin.login');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function authenticateAdmin(Request $request): RedirectResponse
	{
		$input = new AdminLoginRequest(
			$request->input('username'),
			$request->input('password')
		);
		/** @var AdminLoginService $service */
		$service = resolve(AdminLoginService::class);
		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'User tidak ditemukan');
		}
		return redirect()->route('admin.dashboard');
	}

	public function logout(Request $request)
	{
		if (Auth::guard('admin')->user()) {
			Auth::guard('admin')->logout();
			return redirect()->route('auth.admin.login');
		}
		if (Auth::guard('user')->user()) {
			Auth::guard('user')->logout();
		}
		return redirect('/');
	}
}