<?php

namespace App\Http\Services\Pemesanan\ListPemesanan;

use Carbon\Carbon;

class ListPemesananResponse
{
	private ?int $id;
	private int $id_user;
	private float $total;
	private Carbon $created_at;

	/**
	 * @param int|null $id
	 * @param int $id_user
	 * @param float $total
	 * @param Carbon $created_at
	 */
	public function __construct(?int $id, int $id_user, float $total, Carbon $created_at)
	{
		$this->id = $id;
		$this->id_user = $id_user;
		$this->total = $total;
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
}