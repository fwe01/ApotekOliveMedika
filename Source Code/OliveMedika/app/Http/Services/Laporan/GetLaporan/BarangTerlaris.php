<?php

namespace App\Http\Services\Laporan\GetLaporan;

class BarangTerlaris
{
	private int $id;
	private string $nama;
	private float $harga;
	private int $stock;
	private string $gambar;
	private string $type;
	private bool $is_generic;
	private int $terjual;

	/**
	 * @param int $id
	 * @param string $nama
	 * @param float $harga
	 * @param int $stock
	 * @param string $gambar
	 * @param string $type
	 * @param bool $is_generic
	 * @param int $terjual
	 */
	public function __construct(
		int $id,
		string $nama,
		float $harga,
		int $stock,
		string $gambar,
		string $type,
		bool $is_generic,
		int $terjual
	) {
		$this->id = $id;
		$this->nama = $nama;
		$this->harga = $harga;
		$this->stock = $stock;
		$this->gambar = $gambar;
		$this->type = $type;
		$this->is_generic = $is_generic;
		$this->terjual = $terjual;
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
	 * @return int
	 */
	public function getStock(): int
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

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return bool
	 */
	public function isIsGeneric(): bool
	{
		return $this->is_generic;
	}

	/**
	 * @return int
	 */
	public function getTerjual(): int
	{
		return $this->terjual;
	}
}
