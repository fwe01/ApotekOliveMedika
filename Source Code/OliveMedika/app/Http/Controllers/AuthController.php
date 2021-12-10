<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\AdminLogin\AdminLoginRequest;
use App\Http\Services\Admin\AdminLogin\AdminLoginService;
use App\Http\Services\User\UserLogin\UserLoginRequest;
use App\Http\Services\User\UserLogin\UserLoginService;
use App\Http\Services\User\UserRegister\UserRegisterRequest;
use App\Http\Services\User\UserRegister\UserRegisterService;
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

    public function showUserLogin()
    {
        return view('auth.user.login');
    }

    public function showUserRegister()
    {
        return view('user.register.register');
    }

    public function userRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required|unique:admins,username',
                'email' => 'required',
                'password' => 'required',
            ]
        );

        $input = new UserRegisterRequest(
            $request->input('name'),
            $request->input('username'),
            $request->input('email'),
            $request->input('password')
        );
        /** @var UserRegisterService $service */
        $service = resolve(UserRegisterService::class);
        try {
            $service->execute($input);
        } catch (Exception $e) {
            return redirect()->back()->with('alert', 'User tidak ditemukan');
        }

        return redirect()->route('user.home');

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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticateUser(Request $request): RedirectResponse
    {
        $input = new UserLoginRequest(
            $request->input('username'),
            $request->input('password')
        );
        /** @var UserLoginService $service */
        $service = resolve(UserLoginService::class);
        try {
            $service->execute($input);
        } catch (Exception $e) {
            return redirect()->back()->with('alert', 'User tidak ditemukan');
        }
        return redirect()->route('user.home');
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
