<?php

namespace App\Http\Services\User\UserLogin;

use App\Exceptions\OliveMedikaException;
use Illuminate\Support\Facades\Auth;

class UserLoginService
{
    /**
     * @throws OliveMedikaException
     */
    public function execute(UserLoginRequest $request)
    {
        if (Auth::guard('user')->attempt(['username' => $request->getUsername(), 'password' => $request->getPassword()]
        )) {
            request()->session()->regenerate();
            return;
        }

        throw OliveMedikaException::build('user-not-found', 2000);
    }
}
