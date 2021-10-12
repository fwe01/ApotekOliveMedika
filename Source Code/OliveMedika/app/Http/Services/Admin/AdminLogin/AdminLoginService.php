<?php

namespace App\Http\Services\Admin\AdminLogin;

use App\Exceptions\OliveMedikaException;
use Illuminate\Support\Facades\Auth;

class AdminLoginService
{
	/**
	 * @throws OliveMedikaException
	 */
	public function execute(AdminLoginRequest $request)
	{
		if (Auth::guard('admin')->attempt(['username' => $request->getUsername(), 'password' => $request->getPassword()]
		)) {
			request()->session()->regenerate();
			return;
		}
		throw OliveMedikaException::build('user-not-found', 2000);
	}
}