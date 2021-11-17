<?php

namespace App\Http\Services\Pemesanan\FinishPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\Pemesanan;
use App\Models\StatusPemesanan;

class FinishPemesananService
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
	public function execute(FinishPemesananRequest $request)
	{
		$pemesanan = $this->repository->getPemesananById($request->getId());
		if (!$pemesanan) {
			throw OliveMedikaException::build('pemesanan-not-found', 2025);
		}
		$pemesanan = new Pemesanan(
			$pemesanan->getId(),
			$pemesanan->getIdUser(),
			$pemesanan->getBarangs(),
			$pemesanan->getTotal(),
			$pemesanan->getCreatedAt(),
			new StatusPemesanan(StatusPemesanan::SELESAI)
		);

		$this->repository->persist($pemesanan);
	}
}
