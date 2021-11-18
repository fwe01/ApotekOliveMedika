<?php

namespace App\Http\Services\Pemesanan\CreatePemesanan;

class CreatePemesananResponse
{
	private int $id;

	/**
	 * @param int $id
	 */
	public function __construct(int $id)
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
}
