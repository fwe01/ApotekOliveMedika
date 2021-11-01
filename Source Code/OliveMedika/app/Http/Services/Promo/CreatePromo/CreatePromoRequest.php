<?php

namespace App\Http\Services\Promo\CreatePromo;

class CreatePromoRequest
{
	private int $id_barang;
	private float $harga_promo_per_unit;
	private string $tanggal_mulai;
	private string $tanggal_berakhir;

	/**
	 * @param int $id_barang
	 * @param float $harga_promo_per_unit
	 * @param string $tanggal_mulai
	 * @param string $tanggal_berakhir
	 */
	public function __construct(
		int $id_barang,
		float $harga_promo_per_unit,
		string $tanggal_mulai,
		string $tanggal_berakhir
	) {
		$this->id_barang = $id_barang;
		$this->harga_promo_per_unit = $harga_promo_per_unit;
		$this->tanggal_mulai = $tanggal_mulai;
		$this->tanggal_berakhir = $tanggal_berakhir;
	}

	/**
	 * @return int
	 */
	public function getIdBarang(): int
	{
		return $this->id_barang;
	}

	/**
	 * @return float
	 */
	public function getHargaPromoPerUnit(): float
	{
		return $this->harga_promo_per_unit;
	}

	/**
	 * @return string
	 */
	public function getTanggalMulai(): string
	{
		return $this->tanggal_mulai;
	}

	/**
	 * @return string
	 */
	public function getTanggalBerakhir(): string
	{
		return $this->tanggal_berakhir;
	}
}