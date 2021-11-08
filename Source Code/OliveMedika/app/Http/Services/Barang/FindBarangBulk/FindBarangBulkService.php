<?php

namespace App\Http\Services\Barang\FindBarangBulk;

use App\Http\Repositories\BarangRepository;

class FindBarangBulkService
{
    private BarangRepository $barang_repository;

    /**
     * @param BarangRepository $barang_repository
     */
    public function __construct(BarangRepository $barang_repository)
    {
        $this->barang_repository = $barang_repository;
    }


    public function execute(FindBarangBulkRequest $request)
    {
        $barangs = $this->barang_repository->getBarangBulk($request->getIds());

        $barang_response = [];

        foreach ($barangs as $barang) {
            $barang_response[] = new BarangBulkResponse(
                $barang->getId(),
                $barang->getNama(),
                $barang->getHarga(),
                $barang->getGambar(),
            );
        }
        return $barang_response;
    }
}
