<?php

namespace App\Http\Repositories;

use App\Exceptions\OliveMedikaException;
use App\Models\Resep;
use App\Models\StatusResep;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ResepRepository
{
	/**
	 * @return Resep[]|null
	 * @throws OliveMedikaException
	 */
	public function getAllResep(): ?array
	{
		$rows = DB::table('reseps')
			->where('soft_deleted', false)
			->get();

		if (!$rows) {
			return null;
		}

		return $this->buildResepFromRows($rows);
	}

	/**
	 * @param Collection $rows
	 * @return Resep[]
	 * @throws OliveMedikaException
	 */
	private function buildResepFromRows(Collection $rows): array
	{
		/** @var Resep[] $reseps */
		$reseps = [];
		foreach ($rows as $row) {
			$reseps[] = new Resep(
				$row->id,
				$row->id_user,
				$row->gambar,
				$row->keterangan,
				new StatusResep($row->status),
				\Carbon\Carbon::parse($row->created_at)
			);
		}
		return $reseps;
	}

	public function persist(Resep $resep)
	{
		$current_time = Carbon::now();
		if ($resep->getId()) {
			//Update
			DB::table('reseps')->updateOrInsert(
				[
					'id' => $resep->getId()
				],
				[
					'id_user' => $resep->getIdUser(),
					'gambar' => $resep->getGambar(),
					'status' => $resep->getStatus()->getValue(),
					'keterangan' => $resep->getKeterangan(),
					'updated_at' => $current_time,
				]
			);
		} else {
			//Create
			DB::table('reseps')->insert(
				[
					'id_user' => $resep->getIdUser(),
					'gambar' => $resep->getGambar(),
					'status' => $resep->getStatus()->getValue(),
					'keterangan' => $resep->getKeterangan(),
					'created_at' => $current_time,
					'updated_at' => $current_time,
				]
			);
		}
	}

	/**
	 * @throws OliveMedikaException
	 */
	public function getResepById(int $id): ?Resep
	{
		$row = DB::table('reseps')
			->where('soft_deleted', false)
			->where('id', $id)
			->first();

		if (!$row) {
			return null;
		}

		return new Resep(
			$row->id,
			$row->id_user,
			$row->gambar,
			$row->keterangan,
			new StatusResep($row->status),
			\Carbon\Carbon::parse($row->created_at)
		);
	}

	public function delete(int $id)
	{
		DB::table('reseps')
			->where('id', $id)
			->update(
				[
					'soft_deleted' => true
				]
			);
	}
}