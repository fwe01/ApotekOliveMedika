<?php

namespace App\Http\Services\Admin\AdminLogin;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;

class AdminLoginService
{
	public function execute (AdminLoginRequest $request){
		if (Auth::guard('admin')->attempt(['username' => $request->getUsername(), 'password' => $request->getPassword()])) {
			request()->session()->regenerate();
			return;
		}
		throw OliveMedikaException::build('user-not-found', 2000);
	}
}