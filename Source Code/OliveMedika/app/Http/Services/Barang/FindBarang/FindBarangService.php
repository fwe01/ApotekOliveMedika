<?php

namespace App\Http\Services\Barang\FindBarang;


class FindBarangService
{
    private BarangRepository $repository;

    /**
     * @param BarangRepository $repository
     */
    public function __construct(BarangRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws OliveMedikaException
     */
    public function execute(FindBarangRequest $request)
    {
        $barang = $this->repository->getBarangById($request->getId());

        if (!$barang) {
            throw OliveMedikaException::build('barang-not-found', 2008);
        }

        return $barang;
    }
}
