<?php

namespace App\Http\Services\Resep\CreateResep;

use Illuminate\Http\UploadedFile;

class CreateResepRequest
{
	private int $id_user;
	private UploadedFile $gambar;
	private string $status;
	private ?string $keterangan;

	/**
	 * @param int $id_user
	 * @param UploadedFile $gambar
	 * @param string $status
	 * @param string|null $keterangan
	 */
	public function __construct(int $id_user, UploadedFile $gambar, string $status, ?string $keterangan)
	{
		$this->id_user = $id_user;
		$this->gambar = $gambar;
		$this->status = $status;
		$this->keterangan = $keterangan;
	}

	/**
	 * @return int
	 */
	public function getIdUser(): int
	{
		return $this->id_user;
	}

	/**
	 * @return UploadedFile
	 */
	public function getGambar(): UploadedFile
	{
		return $this->gambar;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return string|null
	 */
	public function getKeterangan(): ?string
	{
		return $this->keterangan;
	}
}