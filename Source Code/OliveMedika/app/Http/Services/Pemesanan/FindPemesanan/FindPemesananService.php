<?php

namespace App\Http\Services\Pemesanan\FindPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\Pemesanan;
use App\Models\UserType;

class FindPemesananService
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
	public function execute(FindPemesananRequest $request)
	{
		$pemesanan = $this->repository->getPemesananById($request->getId());
		if (!$pemesanan) {
			throw OliveMedikaException::build('pemesanan-not-found', 2020);
		}
		switch ($request->getUserType()->getValue()) {
			case UserType::USER:
				if (
					$pemesanan->getIdUser() != $request->getIdUser()
				) {
					throw OliveMedikaException::build('pemesanan-not-found', 2021);
				}
				break;
			case UserType::ADMIN:
				break;
		}
		return $this->buildResponse($pemesanan);
	}

	private function buildResponse(Pemesanan $pemesanan)
	{
		/** @var BarangPemesanan $barang_pemesanan_response */
		$barang_pemesanan_response = [];
		foreach ($pemesanan->getBarangs() as $barang) {
			$barang_pemesanan_response[] = new BarangPemesanan(
				$barang->getIdBarang(),
				$barang->getNama(),
				$barang->getHarga(),
				$barang->getQuantity()
			);
		}

		return new FindPemesananResponse(
			$pemesanan->getId(),
			$pemesanan->getIdUser(),
			$barang_pemesanan_response,
			$pemesanan->getTotal(),
			$pemesanan->getCreatedAt()
		);
	}
}