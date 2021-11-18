<?php

namespace App\Http\Services\Pemesanan\DeletePemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\StatusPemesanan;
use App\Models\UserType;

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
		switch ($request->getUserType()->getValue()) {
			case UserType::USER:
				throw new OliveMedikaException('Tidak berhak akses', 2024);
			case UserType::ADMIN:
				break;
		}
		if ($pemesanan->getStatus()->getValue() == StatusPemesanan::SEDANG_DIPROSES ||
			$pemesanan->getStatus()->getValue() == StatusPemesanan::SELESAI
		) {
			throw new OliveMedikaException('Pemesanan sudah selesai atau masih di proses', 2027);
		}
		$this->repository->delete($request->getId());
	}
}
