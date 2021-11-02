<?php

namespace App\Http\Controllers\User;

use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\FullDetailPromo\FullDetailPromoService;

class HomeController
{
    public function showHome()
    {
        /** @var FullDetailPromoService $service */
        $service = resolve(FullDetailPromoService::class);
        $barang_promos = $service->execute();

        $barang_input = new ListBarangRequest(
            new ListBarangOptions(ListBarangOptions::GENERIC)
        );

        /** @var ListBarangService $service */
        $barang_service = resolve(ListBarangService::class);
        $barang = $barang_service->execute($barang_input);
        return view('user.home.home', compact('barang_promos', 'barang'));
    }
}
