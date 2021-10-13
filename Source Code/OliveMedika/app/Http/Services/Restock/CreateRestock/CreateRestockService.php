<?php

namespace App\Http\Services\Restock\CreateRestock;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;
use App\Http\Repositories\RestockRepository;
use App\Models\Barang;
use App\Models\Restock;

class CreateRestockService
{
	private RestockRepository $restock_repository;
	private BarangRepository $barang_repository;

	/**
	 * @param RestockRepository $restock_repository
	 * @param BarangRepository $barang_repository
	 */
	public function __construct(
		RestockRepository $restock_repository,
		BarangRepository $barang_repository
	) {
		$this->restock_repository = $restock_repository;
		$this->barang_repository = $barang_repository;
	}

	public function execute(CreateRestockRequest $request)
	{
		$barang = $this->barang_repository->getBarangById($request->getIdBarang());

		if (!$barang) {
			throw OliveMedikaException::build('barang-not-found', 2009);
		}

		$restock = Restock::create(
			$request->getIdBarang(),
			$request->getUsernameAdmin(),
			$request->getJumlah(),
			$request->getHargaPerUnit()
		);
		$new_barang = new Barang(
			$barang->getId(),
			$barang->getNama(),
			$barang->getHarga(),
			$barang->getStock() + $request->getJumlah(),
			$barang->getGambar(),
			$barang->getType(),
			$barang->isGeneric()
		);

		$this->restock_repository->persist($restock);
		$this->barang_repository->persist($new_barang);
	}
}