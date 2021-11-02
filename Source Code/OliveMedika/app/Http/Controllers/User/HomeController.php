<?php

namespace App\Http\Controllers\User;

class HomeController
{
    public function showHome()
    {
        return view('user.home.home');
    }
}
