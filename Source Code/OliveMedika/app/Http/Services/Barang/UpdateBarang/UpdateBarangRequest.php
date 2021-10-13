<?php

namespace App\Http\Services\Barang\UpdateBarang;

use Illuminate\Http\UploadedFile;

class UpdateBarangRequest
{
	private string $nama;
	private float $harga;
	private bool $is_generic;
	private string $type;
	private ?UploadedFile $gambar;
	private int $id;

	/**
	 * @param int $id
	 * @param string $nama
	 * @param float $harga
	 * @param bool $is_generic
	 * @param string $type
	 * @param UploadedFile|null $gambar
	 */
	public function __construct(
		int $id,
		string $nama,
		float $harga,
		bool $is_generic,
		string $type,
		?UploadedFile $gambar
	) {
		$this->nama = $nama;
		$this->harga = $harga;
		$this->is_generic = $is_generic;
		$this->type = $type;
		$this->gambar = $gambar;
		$this->id = $id;
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
	 * @return UploadedFile|null
	 */
	public function getGambar(): ?UploadedFile
	{
		return $this->gambar;
	}
}