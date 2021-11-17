<?php

namespace App\Http\Controllers\User;

use App\Http\Mechanism\UnitOfWork;
use App\Http\Services\Pemesanan\CancelPemesanan\CancelPemesananRequest;
use App\Http\Services\Pemesanan\CancelPemesanan\CancelPemesananService;
use App\Http\Services\Pemesanan\CreatePemesanan\BarangPemesanan;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananRequest;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananService;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananRequest;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananService;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananRequest;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananService;
use App\Models\UserType;
use Carbon\Carbon;
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

        $request->session()->forget('barang_pesanan');

    }

    function listPesanan()
    {
        $input = new ListPemesananRequest(
            new UserType(UserType::USER),
            Auth::guard('user')->id()
        );
        /** @var ListPemesananService $service */
        $service = resolve(ListPemesananService::class);
        $pemesanans = $service->execute($input);

        return view('user.listPemesanan.listPemesanan', compact('pemesanans'));
    }

    function status($id_pemesanan)
    {
        $input = new FindPemesananRequest(
            $id_pemesanan,
            new UserType(UserType::USER),
            Auth::guard('user')->id()
        );

        /** @var FindPemesananService $service */
        $service = resolve(FindPemesananService::class);

        $pemesanan = $service->execute($input);

        $bisa_batal = $pemesanan->getCreatedAt()->addMinutes(30)->getTimestamp() > Carbon::now()->getTimestamp();


        return view('user.detilStatusPesanan.detilStatusPesanan', compact(['pemesanan', 'bisa_batal']));
    }

    function batalkan(Request $request)
    {
        $input = new CancelPemesananRequest(
            $request->input('id_pemesanan'),
            new UserType(UserType::USER),
            Auth::guard('user')->id()
        );

        /** @var CancelPemesananService $service */
        $service = resolve(CancelPemesananService::class);

        $this->unit_of_work->begin();
        $service->execute($input);
        $this->unit_of_work->commit();

        return "success";
    }
}
