<?php

namespace App\Http\Services\Promo\UpdatePromo;

class UpdatePromoRequest
{
	private int $id;
	private float $harga_promo_per_unit;
	private string $tanggal_mulai;
	private string $tanggal_berakhir;

	/**
	 * @param int $id
	 * @param float $harga_promo_per_unit
	 * @param string $tanggal_mulai
	 * @param string $tanggal_berakhir
	 */
	public function __construct(
		int $id,
		float $harga_promo_per_unit,
		string $tanggal_mulai,
		string $tanggal_berakhir
	) {
		$this->id = $id;
		$this->harga_promo_per_unit = $harga_promo_per_unit;
		$this->tanggal_mulai = $tanggal_mulai;
		$this->tanggal_berakhir = $tanggal_berakhir;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
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