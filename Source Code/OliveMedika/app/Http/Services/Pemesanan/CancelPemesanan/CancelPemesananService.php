<?php

namespace App\Http\Services\Pemesanan\CancelPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;
use App\Http\Repositories\PemesananRepository;
use App\Models\Barang;
use App\Models\BarangPemesanan;
use App\Models\Pemesanan;
use App\Models\StatusPemesanan;
use App\Models\UserType;
use Carbon\Carbon;

class CancelPemesananService
{
	private PemesananRepository $repository;
	private BarangRepository $barang_repository;

	/**
	 * @param PemesananRepository $repository
	 * @param BarangRepository $barang_repository
	 */
	public function __construct(
		PemesananRepository $repository,
		BarangRepository $barang_repository
	) {
		$this->repository = $repository;
		$this->barang_repository = $barang_repository;
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

		$this->revertStock($pemesanan->getBarangs());

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

	/**
	 * @param BarangPemesanan[] $barangs
	 * @throws OliveMedikaException
	 */
	private function revertStock(array $barangs)
	{
		foreach ($barangs as $barang) {
			$barang_from_repo = $this->barang_repository->getBarangById($barang->getIdBarang());
			$barang_from_repo = new Barang(
				$barang_from_repo->getId(),
				$barang_from_repo->getNama(),
				$barang_from_repo->getHarga(),
				$barang_from_repo->getStock() + $barang->getQuantity(),
				$barang_from_repo->getGambar(),
				$barang_from_repo->getType(),
				$barang_from_repo->isGeneric()
			);
			$this->barang_repository->persist($barang_from_repo);
		}
	}
}
