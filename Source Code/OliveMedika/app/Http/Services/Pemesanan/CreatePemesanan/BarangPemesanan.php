<?php

namespace App\Http\Services\Pemesanan\CreatePemesanan;

class BarangPemesanan
{
	private int $id_barang;
	private int $quantity;

	/**
	 * @param int $id_barang
	 * @param int $quantity
	 */
	public function __construct(int $id_barang, int $quantity)
	{
		$this->id_barang = $id_barang;
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
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}


}