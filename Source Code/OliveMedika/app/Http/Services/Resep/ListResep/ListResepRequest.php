<?php

namespace App\Http\Services\Resep\ListResep;

use App\Exceptions\OliveMedikaException;

class ListResepRequest
{
	private ListResepOptions $options;
	private ?int $id_user;

	/**
	 * @param ListResepOptions $options
	 * @param int|null $id_user
	 * @throws OliveMedikaException
	 */
	public function __construct(ListResepOptions $options, ?int $id_user = null)
	{
		$this->options = $options;
		if ($this->options->getValue() === ListResepOptions::USER && $id_user == null) {
			throw new OliveMedikaException('Invalid ListResepRequest, Option USER must be followed with user id', 2013);
		}
		$this->id_user = $id_user;
	}

	/**
	 * @return ListResepOptions
	 */
	public function getOptions(): ListResepOptions
	{
		return $this->options;
	}

	/**
	 * @return int|null
	 */
	public function getIdUser(): ?int
	{
		return $this->id_user;
	}
}