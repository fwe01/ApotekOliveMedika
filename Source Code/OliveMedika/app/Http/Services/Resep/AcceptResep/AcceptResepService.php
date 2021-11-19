<?php

namespace App\Http\Services\Resep\AcceptResep;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\ResepRepository;
use App\Models\Resep;
use App\Models\StatusResep;

class AcceptResepService
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
	public function execute(AcceptResepRequest $request)
	{
		$resep = $this->repository->getResepById($request->getId());

		if (!$resep || $resep->getStatus()->getValue() !== StatusResep::KONFIRMASI) {
			throw new OliveMedikaException('Resep not found', 2026);
		}

		$resep = new Resep(
			$resep->getId(),
			$resep->getIdUser(),
			$resep->getGambar(),
			$resep->getKeterangan(),
			new StatusResep(StatusResep::DITERIMA),
			$resep->getCreatedAt()
		);

		$this->repository->persist($resep);
	}
}
