<?php

namespace App\Http\Services\Pemesanan\CreatePemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\BarangRepository;
use App\Http\Repositories\PemesananRepository;
use App\Http\Repositories\PromoRepository;
use App\Models\Barang;
use App\Models\BarangPemesanan as BarangPemesananModels;
use App\Models\Pemesanan;
use App\Models\User;

class CreatePemesananService
{
	private BarangRepository $barang_repository;
	private PemesananRepository $pemesanan_repository;
	private PromoRepository $promo_repository;

	/**
	 * @param BarangRepository $barang_repository
	 * @param PemesananRepository $pemesanan_repository
	 * @param PromoRepository $promo_repository
	 */
	public function __construct(
		BarangRepository $barang_repository,
		PemesananRepository $pemesanan_repository,
		PromoRepository $promo_repository
	) {
		$this->barang_repository = $barang_repository;
		$this->pemesanan_repository = $pemesanan_repository;
		$this->promo_repository = $promo_repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(CreatePemesananRequest $request): CreatePemesananResponse
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

		$id = $this->pemesanan_repository->persist($pemesanan);

		return new CreatePemesananResponse($id);
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
			$promo_barang = $this->promo_repository->getActivePromoByIdBarang($barang->getIdBarang());

			if (!$barang_from_repo) {
				throw OliveMedikaException::build('barang-not-found', 2016);
			}

			if ($promo_barang) {
				$harga = $barang_from_repo->getHarga() < $promo_barang[0]->getHargaPromoPerUnit() ?
					$barang_from_repo->getHarga() : $promo_barang[0]->getHargaPromoPerUnit();
			} else {
				$harga = $barang_from_repo->getHarga();
			}

			$barang_pemesanan[] = BarangPemesananModels::create(
				$barang_from_repo->getId(),
				$barang_from_repo->getNama(),
				$harga,
				$barang->getQuantity()
			);

			$barang_from_repo = new Barang(
				$barang_from_repo->getId(),
				$barang_from_repo->getNama(),
				$barang_from_repo->getHarga(),
				$barang_from_repo->getStock() - $barang->getQuantity(),
				$barang_from_repo->getGambar(),
				$barang_from_repo->getType(),
				$barang_from_repo->isGeneric()
			);
			$this->barang_repository->persist($barang_from_repo);
		}
		return $barang_pemesanan;
	}
}
