<?php

namespace App\Http\Services\Restock\ListRestock;

use Carbon\Carbon;

class ListRestockResponse
{
	private int $id_barang;
	private string $nama_barang;
	private int $jumlah;
	private float $harga_per_unit;
	private string $username_admin;
	private Carbon $created_at;

	/**
	 * @param int $id_barang
	 * @param string $nama_barang
	 * @param int $jumlah
	 * @param float $harga_per_unit
	 * @param string $username_admin
	 * @param Carbon $created_at
	 */
	public function __construct(
		int $id_barang,
		string $nama_barang,
		int $jumlah,
		float $harga_per_unit,
		string $username_admin,
		Carbon $created_at
	) {
		$this->id_barang = $id_barang;
		$this->nama_barang = $nama_barang;
		$this->jumlah = $jumlah;
		$this->harga_per_unit = $harga_per_unit;
		$this->username_admin = $username_admin;
		$this->created_at = $created_at;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	/**
	 * @return int
	 */
	public function getIdBarang(): int
	{
		return $this->id_barang;
	}

	/**
	 * @return string
	 */
	public function getNamaBarang(): string
	{
		return $this->nama_barang;
	}

	/**
	 * @return int
	 */
	public function getJumlah(): int
	{
		return $this->jumlah;
	}

	/**
	 * @return float
	 */
	public function getHargaPerUnit(): float
	{
		return $this->harga_per_unit;
	}

	/**
	 * @return string
	 */
	public function getUsernameAdmin(): string
	{
		return $this->username_admin;
	}
}