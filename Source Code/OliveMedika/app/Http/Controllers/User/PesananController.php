<?php

namespace App\Http\Controllers\User;

use App\Http\Mechanism\UnitOfWork;
use App\Http\Services\Pemesanan\CreatePemesanan\BarangPemesanan;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananRequest;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController
{
    private UnitOfWork $unit_of_work;

    /**
     * @param UnitOfWork $unit_of_work
     */
    public function __construct(UnitOfWork $unit_of_work)
    {
        $this->unit_of_work = $unit_of_work;
    }


    function pesan(Request $request)
    {
        $user = Auth::guard('user')->user();

        /** @var BarangPemesanan $barang_pesanan */
        $barang_pesanan = [];
        foreach ($request->input('barang') as $barang) {
            $barang_pesanan[] = new BarangPemesanan(
                $barang['id'],
                $barang['quantity'],
            );

        }

        $barang_input = new CreatePemesananRequest(
            $user->id,
            $barang_pesanan
        );

        /** @var CreatePemesananService $service */
        $barang_service = resolve(CreatePemesananService::class);

        $this->unit_of_work->begin();
        $barang = $barang_service->execute($barang_input);
        $this->unit_of_work->commit();

    }

}
