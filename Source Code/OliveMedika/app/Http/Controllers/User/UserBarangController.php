<?php

namespace App\Http\Controllers\User;


use App\Http\Services\Barang\FindBarang\FindBarangRequest;
use App\Http\Services\Barang\FindBarang\FindBarangService;
use App\Http\Services\Barang\FindBarangBulk\FindBarangBulkRequest;
use App\Http\Services\Barang\FindBarangBulk\FindBarangBulkService;
use Illuminate\Http\Request;

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

    public function pesananDetil(Request $request)
    {
        $barang_pesanan = json_decode($request->session()->get('barang_pesanan'));

        $barang_input = new FindBarangBulkRequest($barang_pesanan);

        /** @var FindBarangBulkService $service */
        $barang_service = resolve(FindBarangBulkService::class);
        $barangs = $barang_service->execute($barang_input);

        return view('user.detilPesanan.detilPesanan', compact('barangs'));
    }

    public function pesananDetilProses(Request $request)
    {
        $barang_pesanan = json_decode($request->session()->get('barang_pesanan'));
        if (!$barang_pesanan) $barang_pesanan = [];

        $barang_id = $request->input('barang_id');
        if (!in_array($barang_id, $barang_pesanan))
            $barang_pesanan[] = $barang_id;

        $request->session()->put('barang_pesanan', json_encode($barang_pesanan, JSON_NUMERIC_CHECK));
    }
}
