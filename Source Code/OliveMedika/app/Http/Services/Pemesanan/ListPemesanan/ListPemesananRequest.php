<?php

namespace App\Http\Services\Pemesanan\ListPemesanan;

use App\Models\UserType;

class ListPemesananRequest
{
	private UserType $user_type;
	private int $id_user;

	/**
	 * @param UserType $user_type
	 * @param int $id_user
	 */
	public function __construct(UserType $user_type, int $id_user)
	{
		$this->user_type = $user_type;
		$this->id_user = $id_user;
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