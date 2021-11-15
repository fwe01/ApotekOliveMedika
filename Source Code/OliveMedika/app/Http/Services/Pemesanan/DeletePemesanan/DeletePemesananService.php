<?php

namespace App\Http\Services\Pemesanan\DeletePemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\UserType;
use Carbon\Carbon;

class DeletePemesananService
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
	public function execute(DeletePemesananRequest $request)
	{
		$pemesanan = $this->repository->getPemesananById($request->getId());
		if (!$pemesanan) {
			throw OliveMedikaException::build('pemesanan-not-found', 2018);
		}
		switch ($request->getUserType()) {
			case UserType::USER:
				$current_time = Carbon::now();
				if (
					$pemesanan->getIdUser() != $request->getIdUser() ||
					$current_time->getTimestamp() > $pemesanan->getCreatedAt()->addMinutes(30)->getTimestamp()
				) {
					throw new OliveMedikaException('Pemesanan tidak dapat dihapus setelah melewati 30 menit', 2019);
				}
				break;
			case UserType::ADMIN:
				break;
		}
		$this->repository->delete($request->getId());
	}
}