<?php

namespace App\Http\Services\Promo\DeletePromo;

use App\Http\Repositories\PromoRepository;

class DeletePromoService
{
	private PromoRepository $repository;

	/**
	 * @param PromoRepository $repository
	 */
	public function __construct(PromoRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(DeletePromoRequest $request)
	{
		$this->repository->delete($request->getId());
	}
}