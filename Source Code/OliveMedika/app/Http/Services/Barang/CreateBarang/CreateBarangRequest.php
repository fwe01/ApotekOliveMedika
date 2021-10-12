<?php

namespace App\Http\Services\Barang\CreateBarang;


use Illuminate\Http\UploadedFile;

class CreateBarangRequest
{
	private string $nama;
	private float $harga;
	private int $stock;
	private bool $is_generic;
	private string $type;
	private UploadedFile $gambar;

	/**
	 * @param string $nama
	 * @param float $harga
	 * @param int $stock
	 * @param bool $is_generic
	 * @param string $type
	 * @param UploadedFile $gambar
	 */
	public function __construct(
		string $nama,
		float $harga,
		int $stock,
		bool $is_generic,
		string $type,
		UploadedFile $gambar
	) {
		$this->nama = $nama;
		$this->harga = $harga;
		$this->stock = $stock;
		$this->is_generic = $is_generic;
		$this->type = $type;
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
	 * @return int
	 */
	public function getStock(): int
	{
		return $this->stock;
	}

	/**
	 * @return bool
	 */
	public function isGeneric(): bool
	{
		return $this->is_generic;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return UploadedFile
	 */
	public function getGambar(): UploadedFile
	{
		return $this->gambar;
	}
}