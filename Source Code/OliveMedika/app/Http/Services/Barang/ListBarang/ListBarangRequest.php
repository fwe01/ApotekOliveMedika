<?php

namespace App\Http\Services\Barang\ListBarang;

class ListBarangRequest
{
	private ListBarangOptions $options;

	/**
	 * @param ListBarangOptions $options
	 */
	public function __construct(ListBarangOptions $options)
	{
		$this->options = $options;
	}

	/**
	 * @return ListBarangOptions
	 */
	public function getOptions(): ListBarangOptions
	{
		return $this->options;
	}
}