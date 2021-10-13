<?php

namespace App\Http\Services\Barang\CreateBarang;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\ImageManager;
use App\Http\Repositories\BarangRepository;
use App\Models\Barang;
use App\Models\TypeBarang;

class CreateBarangService
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
	public function execute(CreateBarangRequest $request)
	{
		$filename = str_replace(' ', '-', strtolower($request->getNama()));
		$path_gambar = ImageManager::saveImage($filename, $request->getGambar(), 'barang');
		$barang = Barang::create(
			$request->getNama(),
			$request->getHarga(),
			$request->getStock(),
			$path_gambar,
			new TypeBarang($request->getType()),
			$request->isGeneric()
		);
		$this->repository->persist($barang);
	}
}