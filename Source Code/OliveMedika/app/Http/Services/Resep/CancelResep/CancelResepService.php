<?php

namespace App\Http\Services\Resep\CancelResep;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\ResepRepository;
use App\Models\Resep;
use App\Models\StatusResep;

class CancelResepService
{
	private ResepRepository $repository;

	/**
	 * @param ResepRepository $repository
	 */
	public function __construct(ResepRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(CancelResepRequest $request)
	{
		$resep = $this->repository->getResepById($request->getId());

		if (!$resep) {
			throw new OliveMedikaException('Resep not found', 2026);
		}

		$resep = new Resep(
			$resep->getId(),
			$resep->getIdUser(),
			$resep->getGambar(),
			$resep->getKeterangan(),
			new StatusResep(StatusResep::DITOLAK),
			$resep->getCreatedAt()
		);

		$this->repository->persist($resep);
	}
}
