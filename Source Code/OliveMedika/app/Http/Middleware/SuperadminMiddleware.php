<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param Closure $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if (Auth::guard('admin')->user()->username !== 'superadmin') {
			return redirect()->back()->with('alert', 'Anda tidak memiliki akses!');
		}
		return $next($request);
	}
}
