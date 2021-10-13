<?php

namespace App\Http\Services\Barang\ListBarang;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;
use App\Models\Barang;

class ListBarangService
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
	public function execute(ListBarangRequest $request): array
	{
		switch ($request->getOptions()->getValue()) {
			case ListBarangOptions::ALL :
				return $this->getAllBarang();
			case ListBarangOptions::GENERIC :
				return $this->getBarangGeneric();
			default :
				throw new OliveMedikaException('Invalid list barang options', 2006);
		}
	}

	/**
	 * @return ListBarangResponse[]
	 * @throws OliveMedikaException
	 */
	private function getAllBarang(): array
	{
		$barangs = $this->repository->getAllBarang();
		return $this->buildListBarangResponse($barangs);
	}

	/**
	 * @param Barang[]|null $barangs
	 * @return ListBarangResponse[]
	 */
	private function buildListBarangResponse(?array $barangs): array
	{
		/** @var ListBarangResponse[] $barang_response */
		$barang_response = [];
		foreach ($barangs as $barang) {
			$barang_response[] = new ListBarangResponse(
				$barang->getId(),
				$barang->getNama(),
				$barang->getHarga(),
				$barang->getStock(),
				$barang->getGambar(),
				$barang->getType()->getValue(),
				$barang->isGeneric(),
			);
		}
		return $barang_response;
	}

	/**
	 * @return ListBarangResponse[]
	 * @throws OliveMedikaException
	 */
	private function getBarangGeneric(): array
	{
		$barangs = $this->repository->getBarangGeneric();
		return $this->buildListBarangResponse($barangs);
	}
}