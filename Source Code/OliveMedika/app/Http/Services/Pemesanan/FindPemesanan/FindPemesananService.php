<?php

namespace App\Http\Services\Pemesanan\FindPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\UserType;

class FindPemesananService
{
	private PemesananRepository $pemesanan_repository;

	/**
	 * @param PemesananRepository $pemesanan_repository
	 */
	public function __construct(PemesananRepository $pemesanan_repository)
	{
		$this->pemesanan_repository = $pemesanan_repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(FindPemesananRequest $request)
	{
		$pemesanan = $this->pemesanan_repository->getPemesananById($request->getId());
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
			$pemesanan->getCreatedAt(),
			User::where('id', $pemesanan->getId())->first()->name
		);
	}
}