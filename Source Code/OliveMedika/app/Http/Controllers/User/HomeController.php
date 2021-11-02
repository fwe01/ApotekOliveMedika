<?php

namespace App\Http\Controllers\User;

use App\Http\Services\FullDetailPromo\FullDetailPromoService;

class HomeController
{
    public function getFullDetailPromo()
    {

    }

    public function showHome()
    {
        /** @var FullDetailPromoService $service */
        $service = resolve(FullDetailPromoService::class);
        $barang_promos = $service->execute();
        return view('user.home.home', compact('barang_promos'));
    }
}
