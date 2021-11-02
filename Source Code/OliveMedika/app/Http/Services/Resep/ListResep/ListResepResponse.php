<?php

namespace App\Http\Services\Resep\ListResep;

use Carbon\Carbon;

class ListResepResponse
{
	private int $id;
	private string $nama_user;
	private int $id_user;
	private string $gambar;
	private string $status;
	private Carbon $created_at;
	private ?string $keterangan;

	/**
	 * @param int $id
	 * @param string $nama_user
	 * @param int $id_user
	 * @param string $gambar
	 * @param string $status
	 * @param Carbon $created_at
	 * @param string|null $keterangan
	 */
	public function __construct(
		int $id,
		string $nama_user,
		int $id_user,
		string $gambar,
		string $status,
		Carbon $created_at,
		?string $keterangan
	) {
		$this->id = $id;
		$this->nama_user = $nama_user;
		$this->id_user = $id_user;
		$this->gambar = $gambar;
		$this->status = $status;
		$this->created_at = $created_at;
		$this->keterangan = $keterangan;
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
	public function getNamaUser(): string
	{
		return $this->nama_user;
	}

	/**
	 * @return int
	 */
	public function getIdUser(): int
	{
		return $this->id_user;
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
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	/**
	 * @return string|null
	 */
	public function getKeterangan(): ?string
	{
		return $this->keterangan;
	}
}