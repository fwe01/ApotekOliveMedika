<?php

namespace App\Http\Services\Pemesanan\FindPemesanan;

class BarangPemesanan
{
	private int $id_barang;
	private string $nama;
	private float $harga;
	private int $quantity;

	/**
	 * @param int $id_barang
	 * @param string $nama
	 * @param float $harga
	 * @param int $quantity
	 */
	public function __construct(int $id_barang, string $nama, float $harga, int $quantity)
	{
		$this->id_barang = $id_barang;
		$this->nama = $nama;
		$this->harga = $harga;
		$this->quantity = $quantity;
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
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}
}