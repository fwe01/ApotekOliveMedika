<?php

namespace App\Http\Services\Promo\ListPromo;

use Carbon\Carbon;

class ListPromoResponse
{
	private ?int $id;
	private string $nama_barang;
	private float $harga_promo_per_unit;
	private Carbon $tanggal_mulai;
	private Carbon $tanggal_berakhir;
	private Carbon $created_at;

	/**
	 * @param int|null $id
	 * @param string $nama_barang
	 * @param float $harga_promo_per_unit
	 * @param Carbon $tanggal_mulai
	 * @param Carbon $tanggal_berakhir
	 * @param Carbon $created_at
	 */
	public function __construct(
		?int $id,
		string $nama_barang,
		float $harga_promo_per_unit,
		Carbon $tanggal_mulai,
		Carbon $tanggal_berakhir,
		Carbon $created_at
	) {
		$this->id = $id;
		$this->nama_barang = $nama_barang;
		$this->harga_promo_per_unit = $harga_promo_per_unit;
		$this->tanggal_mulai = $tanggal_mulai;
		$this->tanggal_berakhir = $tanggal_berakhir;
		$this->created_at = $created_at;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getNamaBarang(): string
	{
		return $this->nama_barang;
	}

	/**
	 * @return float
	 */
	public function getHargaPromoPerUnit(): float
	{
		return $this->harga_promo_per_unit;
	}

	/**
	 * @return Carbon
	 */
	public function getTanggalMulai(): Carbon
	{
		return $this->tanggal_mulai;
	}

	/**
	 * @return Carbon
	 */
	public function getTanggalBerakhir(): Carbon
	{
		return $this->tanggal_berakhir;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}
}