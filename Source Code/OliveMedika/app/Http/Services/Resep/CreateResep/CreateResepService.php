<?php

namespace App\Http\Services\Resep\CreateResep;

use App\Exceptions\OliveMedikaException;
use App\Http\Mechanism\ImageManager;
use App\Http\Repositories\ResepRepository;
use App\Models\Resep;
use App\Models\StatusResep;
use Carbon\Carbon;

class CreateResepService
{
	private ResepRepository $repository;

	/**
	 * @param ResepRepository $repository
	 */
	public function __construct(ResepRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function execute(CreateResepRequest $request)
	{
		$filename = 'resep_pesanan_' . $request->getIdUser() . '_' . Carbon::now()->format('d_m_Y_h_i_s');
		$path_gambar = ImageManager::saveImage($filename, $request->getGambar(), 'resep');
		$resep = Resep::create(
			$request->getIdUser(),
			$path_gambar,
			$request->getKeterangan(),
			new StatusResep($request->getStatus())
		);
		$this->repository->persist($resep);
	}
}