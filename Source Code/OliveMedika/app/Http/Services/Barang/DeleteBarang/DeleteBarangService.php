<?php

namespace App\Http\Services\Barang\DeleteBarang;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;

class DeleteBarangService
{
	private BarangRepository $repository;

	/**
	 * @param BarangRepository $repository
	 */
	public function __construct(BarangRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(DeleteBarangRequest $request)
	{
		$barang = $this->repository->getBarangById($request->getId());

		if (!$barang) {
			throw OliveMedikaException::build('barang-not-found', 2007);
		}

		$this->repository->delete($barang->getId());
	}
}