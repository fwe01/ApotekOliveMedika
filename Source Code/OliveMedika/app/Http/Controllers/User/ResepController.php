<?php

namespace App\Http\Controllers\User;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Resep\CreateResep\CreateResepRequest;
use App\Http\Services\Resep\CreateResep\CreateResepService;
use App\Http\Services\Resep\ListResep\ListResepOptions;
use App\Http\Services\Resep\ListResep\ListResepRequest;
use App\Http\Services\Resep\ListResep\ListResepService;
use App\Models\StatusResep;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController
{
    public function add(Request $request)
    {
        if (!$request->file('gambar'))
            return redirect()->back()->with('alert', 'Mohon Pilih Resep Terlebih Dahulu');
        $input = new CreateResepRequest(
            Auth::guard('user')->user()->id,
            $request->file('gambar'),
            StatusResep::KONFIRMASI,
            null
        );

        /** @var CreateResepService $service */
        $service = resolve(CreateResepService::class);

        try {
            $service->execute($input);
        } catch (Exception $e) {
            return redirect()->back()->with(
                'alert',
                'Gagal menambahkan pesanan resep' . $e instanceof OliveMedikaException ? $e->getMessage() : ''
            );
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan pesanan resep');
    }

    public function create()
    {

        $input = new ListResepRequest(
            new ListResepOptions(ListResepOptions::USER),
            Auth::guard('user')->user()->id
        );

        /** @var ListResepService $service */
        $service = resolve(ListResepService::class);

        $reseps = $service->execute($input);

        return view('user.resep.add', compact(['reseps']));
    }
}
