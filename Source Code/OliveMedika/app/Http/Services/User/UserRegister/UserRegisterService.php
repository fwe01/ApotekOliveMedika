<?php

namespace App\Http\Services\User\UserRegister;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegisterService
{
    public function execute(UserRegisterRequest $request)
    {
        User::create([
            "name" => $request->getName(),
            "username" => $request->getUsername(),
            "email" => $request->getEmail(),
            "password" => Hash::make($request->getPassword()),
        ]);
    }

}
