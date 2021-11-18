<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

class DashboardController
{
	public function showDashboard(): RedirectResponse
	{
		return redirect()->route('admin.pemesanans.index');
	}
}

