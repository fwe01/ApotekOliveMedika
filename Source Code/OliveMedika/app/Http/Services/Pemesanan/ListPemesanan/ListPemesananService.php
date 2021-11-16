<?php

namespace App\Http\Services\Pemesanan\ListPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\Pemesanan;
use App\Models\UserType;

class ListPemesananService
{
	private PemesananRepository $repository;

	/**
	 * @param PemesananRepository $repository
	 */
	public function __construct(PemesananRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(ListPemesananRequest $request)
	{
		switch ($request->getUserType()->getValue()) {
			case UserType::USER:
				return $this->getUserResponse($request->getIdUser());
			case UserType::ADMIN:
				return $this->getAdminResponse();
		}
	}

	/**
	 * @throws OliveMedikaException
	 */
	private function getUserResponse(int $id_user): array
	{
		$pemesanans = $this->repository->getAllPemesananWithoutBarang($id_user);
		return $this->buildResponseFromPemesanans($pemesanans);
	}

	/**
	 * @param Pemesanan[]|null $pemesanans
	 * @throws OliveMedikaException
	 */
	private function buildResponseFromPemesanans(?array $pemesanans): array
	{
		$response = [];
		foreach ($pemesanans as $pemesanan) {
			$response[] = new ListPemesananResponse(
				$pemesanan->getId(),
				$pemesanan->getIdUser(),
				$pemesanan->getTotal(),
				$pemesanan->getCreatedAt(),
			);
		}
		return $response;
	}

	/**
	 * @throws OliveMedikaException
	 */
	private function getAdminResponse(): array
	{
		$pemesanans = $this->repository->getAllPemesananWithoutBarang();
		return $this->buildResponseFromPemesanans($pemesanans);
	}
}