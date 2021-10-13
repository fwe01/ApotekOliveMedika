<?php

namespace App\Http\Services\Restock\CreateRestock;

use App\Http\Repositories\RestockRepository;
use App\Models\Restock;

class CreateRestockService
{
	private RestockRepository $repository;

	/**
	 * @param RestockRepository $repository
	 */
	public function __construct(RestockRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(CreateRestockRequest $request)
	{
		$restock = Restock::create(
			$request->getIdBarang(),
			$request->getUsernameAdmin(),
			$request->getJumlah(),
			$request->getHargaPerUnit()
		);

		$this->repository->persist($restock);
	}
}