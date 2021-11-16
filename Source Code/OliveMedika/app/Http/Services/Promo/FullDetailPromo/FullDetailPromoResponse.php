<?php

namespace App\Http\Services\Promo\FullDetailPromo;

class FullDetailPromoResponse
{
    private string $nama;
    private float $harga;
    private float $harga_promo;
    private string $stock;
    private string $gambar;

    /**
     * @param string $nama
     * @param float $harga
     * @param float $harga_promo
     * @param string $stock
     * @param string $gambar
     */
    public function __construct(string $nama, float $harga, float $harga_promo, string $stock, string $gambar)
    {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->harga_promo = $harga_promo;
        $this->stock = $stock;
        $this->gambar = $gambar;
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
     * @return float
     */
    public function getHargaPromo(): float
    {
        return $this->harga_promo;
    }

    /**
     * @return string
     */
    public function getStock(): string
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getGambar(): string
    {
        return $this->gambar;
    }
}
