<?php

namespace App\Http\Services\Barang\UpdateBarang;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\ImageManager;
use App\Http\Repositories\BarangRepository;
use App\Models\Barang;
use App\Models\TypeBarang;

class UpdateBarangService
{
	private BarangRepository $repository;

	/**
	 * @param BarangRepository $repository
	 */
	public function __construct(BarangRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(UpdateBarangRequest $request)
	{
		$barang = $this->repository->getBarangById($request->getId());

		if (!$barang) {
			throw OliveMedikaException::build('barang-not-found', 2008);
		}

		$path_gambar = null;
		$filename = str_replace(' ', '-', strtolower($request->getNama()));
		if ($request->getGambar()) {
			$path_gambar = ImageManager::saveImage($filename, $request->getGambar(), 'barang');
		} else {
			$path_gambar = ImageManager::moveImage($barang->getGambar(), $filename, 'barang');
		}

		$new_barang = new Barang(
			$barang->getId(),
			$request->getNama(),
			$request->getHarga(),
			$barang->getStock(),
			$path_gambar,
			new TypeBarang($request->getType()),
			$request->isGeneric()
		);

		$this->repository->persist($new_barang);
	}
}