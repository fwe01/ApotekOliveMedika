<?php

namespace App\Http\Services\Pemesanan\CreatePemesanan;

class CreatePemesananRequest
{
	private int $user_id;
	/** @var BarangPemesanan[] $barangs */
	private array $barangs;

	/**
	 * @param int $user_id
	 * @param BarangPemesanan[] $barangs
	 */
	public function __construct(int $user_id, array $barangs)
	{
		$this->user_id = $user_id;
		$this->barangs = $barangs;
	}

	/**
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->user_id;
	}

	/**
	 * @return BarangPemesanan[]
	 */
	public function getBarangs(): array
	{
		return $this->barangs;
	}
}