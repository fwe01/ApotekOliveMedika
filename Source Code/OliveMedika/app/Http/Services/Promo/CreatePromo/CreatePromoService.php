<?php

namespace App\Http\Services\Promo\CreatePromo;

use App\Http\Repositories\PromoRepository;
use App\Models\Promo;
use Carbon\Carbon;

class CreatePromoService
{
	private PromoRepository $repository;

	/**
	 * @param PromoRepository $repository
	 */
	public function __construct(PromoRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(CreatePromoRequest $request)
	{
		$barang = Promo::create(
			$request->getIdBarang(),
			$request->getHargaPromoPerUnit(),
			Carbon::createFromFormat('d/m/Y', $request->getTanggalMulai())->startOfDay(),
			Carbon::createFromFormat('d/m/Y', $request->getTanggalBerakhir())->endOfDay(),
		);
		$this->repository->persist($barang);
	}
}