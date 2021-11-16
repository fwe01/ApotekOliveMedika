<?php

namespace App\Http\Services\Pemesanan\CreatePemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;
use App\Http\Repositories\PemesananRepository;
use App\Models\BarangPemesanan as BarangPemesananModels;
use App\Models\Pemesanan;
use App\Models\User;

class CreatePemesananService
{
	private BarangRepository $barang_repository;
	private PemesananRepository $pemesanan_repository;

	/**
	 * @param BarangRepository $barang_repository
	 * @param PemesananRepository $pemesanan_repository
	 */
	public function __construct(BarangRepository $barang_repository, PemesananRepository $pemesanan_repository)
	{
		$this->barang_repository = $barang_repository;
		$this->pemesanan_repository = $pemesanan_repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(CreatePemesananRequest $request)
	{
		$user = User::where('id', $request->getUserId())->first();

		if (!$user) {
			throw OliveMedikaException::build('user-not-found', 2015);
		}

		$barang_pemesanan = $this->buildBarangPemesanan($request->getBarangs());

		$pemesanan = Pemesanan::create(
			$request->getUserId(),
			$barang_pemesanan
		);

		$this->pemesanan_repository->persist($pemesanan);
	}


	/**
	 * @param BarangPemesanan[] $barangs
	 * @throws OliveMedikaException
	 */
	private function buildBarangPemesanan(array $barangs)
	{
		$barang_pemesanan = [];
		foreach ($barangs as $barang) {
			$barang_from_repo = $this->barang_repository->getBarangById($barang->getIdBarang());

			if (!$barang_from_repo) {
				throw OliveMedikaException::build('barang-not-found', 2016);
			}

			$barang_pemesanan[] = BarangPemesananModels::create(
				$barang_from_repo->getId(),
				$barang_from_repo->getNama(),
				$barang_from_repo->getHarga(),
				$barang->getQuantity()
			);
		}
		return $barang_pemesanan;
	}
}