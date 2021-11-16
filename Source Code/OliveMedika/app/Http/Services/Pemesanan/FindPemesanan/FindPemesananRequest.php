<?php

namespace App\Http\Services\Pemesanan\FindPemesanan;

use App\Models\UserType;

class FindPemesananRequest
{
	private int $id;
	private UserType $user_type;
	private int $id_user;

	/**
	 * @param int $id
	 * @param UserType $user_type
	 * @param int $id_user
	 */
	public function __construct(int $id, UserType $user_type, int $id_user)
	{
		$this->id = $id;
		$this->user_type = $user_type;
		$this->id_user = $id_user;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return UserType
	 */
	public function getUserType(): UserType
	{
		return $this->user_type;
	}

	/**
	 * @return int
	 */
	public function getIdUser(): int
	{
		return $this->id_user;
	}
}