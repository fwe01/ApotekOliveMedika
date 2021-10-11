<?php

namespace App\Http\Repositories;

use App\Http\Services\Admin\AdminLogin\AdminLoginRequest;
use Illuminate\Support\Facades\DB;

class AdminRepository
{
	public function getAdminByUsername(string $username){
		$row =  DB::table('admins')->whereRaw('BINARY username = ?', [$username])->first();
		if (!$row){
			return null;
		}
	}
}