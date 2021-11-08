<?php

namespace App\Http\Services\Barang\FindBarangBulk;

class BarangBulkResponse
{
    private int $id;
    private string $nama;
    private float $harga;
    private string $gambar;

    /**
     * @param int $id
     * @param string $nama
     * @param float $harga
     * @param string $gambar
     */
    public function __construct(int $id, string $nama, float $harga, string $gambar)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return float
     */
    public function getHarga(): float
    {
        return $this->harga;
    }

    /**
     * @return string
     */
    public function getGambar(): string
    {
        return $this->gambar;
    }


}
