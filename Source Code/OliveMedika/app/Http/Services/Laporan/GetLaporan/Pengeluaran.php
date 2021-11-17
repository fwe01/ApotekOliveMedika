<?php

namespace App\Http\Services\Laporan\GetLaporan;

use Carbon\Carbon;

class Pengeluaran
{
	private ?int $id;
	private int $id_barang;
	private string $nama_barang;
	private string $username_admin;
	private int $jumlah;
	private float $harga_per_unit;
	private Carbon $created_at;

	/**
	 * @param int|null $id
	 * @param int $id_barang
	 * @param string $nama_barang
	 * @param string $username_admin
	 * @param int $jumlah
	 * @param float $harga_per_unit
	 * @param Carbon $created_at
	 */
	public function __construct(
		?int $id,
		int $id_barang,
		string $nama_barang,
		string $username_admin,
		int $jumlah,
		float $harga_per_unit,
		Carbon $created_at
	) {
		$this->id = $id;
		$this->id_barang = $id_barang;
		$this->nama_barang = $nama_barang;
		$this->username_admin = $username_admin;
		$this->jumlah = $jumlah;
		$this->harga_per_unit = $harga_per_unit;
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

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}
}
