<?php

namespace App\Http\Controllers\User;


use App\Http\Services\Barang\FindBarang\FindBarangRequest;
use App\Http\Services\Barang\FindBarang\FindBarangService;

class UserBarangController
{
    public function barangDetail($id)
    {
        $barang_input = new FindBarangRequest($id);

        /** @var FindBarangService $service */
        $barang_service = resolve(FindBarangService::class);
        $barang = $barang_service->execute($barang_input);
        return view('user.detilBarang.detilBarang', compact('barang'));
    }
}
