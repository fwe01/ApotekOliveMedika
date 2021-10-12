<?php

namespace App\Http\Controllers\Admin;

class DashboardController
{
	public function showDashboard()
	{
		return view('admin.dashboard');
	}
}