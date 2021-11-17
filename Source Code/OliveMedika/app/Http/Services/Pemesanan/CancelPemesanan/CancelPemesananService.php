<?php

namespace App\Http\Services\Pemesanan\CancelPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\Pemesanan;
use App\Models\StatusPemesanan;
use App\Models\UserType;
use Carbon\Carbon;

class CancelPemesananService
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
	public function execute(CancelPemesananRequest $request)
	{
		$pemesanan = $this->repository->getPemesananById($request->getId());
		if (!$pemesanan) {
			throw OliveMedikaException::build('pemesanan-not-found', 2022);
		}
		switch ($request->getUserType()->getValue()) {
			case UserType::USER:
				$current_time = Carbon::now();
				if (
					$pemesanan->getIdUser() != $request->getIdUser() ||
					$current_time->getTimestamp() > $pemesanan->getCreatedAt()->addMinutes(30)->getTimestamp()
				) {
					throw new OliveMedikaException('Pemesanan tidak dapat dibatalkan setelah melewati 30 menit', 2023);
				}
				break;
			case UserType::ADMIN:
				break;
		}
		$pemesanan = new Pemesanan(
			$pemesanan->getId(),
			$pemesanan->getIdUser(),
			$pemesanan->getBarangs(),
			$pemesanan->getTotal(),
			$pemesanan->getCreatedAt(),
			new StatusPemesanan(StatusPemesanan::DIBATALKAN)
		);

		$this->repository->persist($pemesanan);
	}
}
