<?php

namespace App\Http\Services\Restock\CreateRestock;

class CreateRestockRequest
{
	private int $id_barang;
	private string $username_admin;
	private int $jumlah;
	private float $harga_per_unit;

	/**
	 * @param int $id_barang
	 * @param string $username_admin
	 * @param int $jumlah
	 * @param float $harga_per_unit
	 */
	public function __construct(int $id_barang, string $username_admin, int $jumlah, float $harga_per_unit)
	{
		$this->id_barang = $id_barang;
		$this->username_admin = $username_admin;
		$this->jumlah = $jumlah;
		$this->harga_per_unit = $harga_per_unit;
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
	public function getUsernameAdmin(): string
	{
		return $this->username_admin;
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
}