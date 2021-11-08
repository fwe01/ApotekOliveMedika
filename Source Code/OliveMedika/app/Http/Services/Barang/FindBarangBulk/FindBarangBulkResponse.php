<?php

namespace App\Http\Services\Barang\FindBarangBulk;

class FindBarangBulkResponse
{

    /**
     * @var BarangBulkResponse[]
     */
    private array $barangs;

    /**
     * @param BarangBulkResponse[] $barangs
     */
    public function __construct(array $barangs)
    {
        $this->barangs = $barangs;
    }

    /**
     * @return BarangBulkResponse[]
     */
    public function getBarangs(): array
    {
        return $this->barangs;
    }


}
