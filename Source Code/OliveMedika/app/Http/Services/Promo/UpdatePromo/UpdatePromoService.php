<?php

namespace App\Http\Services\Promo\UpdatePromo;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PromoRepository;
use App\Models\Promo;
use Carbon\Carbon;

class UpdatePromoService
{
	private PromoRepository $repository;

	/**
	 * @param PromoRepository $repository
	 */
	public function __construct(PromoRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(UpdatePromoRequest $request)
	{
		$promo = $this->repository->getPromoById($request->getId());

		if (!$promo) {
			throw OliveMedikaException::build('promo-not-found', 2010);
		}

		$promo = new Promo(
			$promo->getId(),
			$promo->getIdBarang(),
			$request->getHargaPromoPerUnit(),
			Carbon::createFromFormat('d/m/Y', $request->getTanggalMulai())->startOfDay(),
			Carbon::createFromFormat('d/m/Y', $request->getTanggalBerakhir())->endOfDay(),
			$promo->getCreatedAt()
		);
		$this->repository->persist($promo);
	}
}