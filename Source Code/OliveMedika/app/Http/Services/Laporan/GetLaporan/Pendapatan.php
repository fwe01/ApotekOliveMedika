<?php

namespace App\Http\Services\Laporan\GetLaporan;

use Carbon\Carbon;

class Pendapatan
{
	private int $id_pemesanan;
	private int $id_user;
	private float $total;
	private Carbon $created_at;
	private string $name;

	/**
	 * @param int $id_pemesanan
	 * @param int $id_user
	 * @param float $total
	 * @param Carbon $created_at
	 * @param string $name
	 */
	public function __construct(int $id_pemesanan, int $id_user, float $total, Carbon $created_at, string $name)
	{
		$this->id_pemesanan = $id_pemesanan;
		$this->id_user = $id_user;
		$this->total = $total;
		$this->created_at = $created_at;
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getIdPemesanan(): int
	{
		return $this->id_pemesanan;
	}

	/**
	 * @return int
	 */
	public function getIdUser(): int
	{
		return $this->id_user;
	}

	/**
	 * @return float
	 */
	public function getTotal(): float
	{
		return $this->total;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}
