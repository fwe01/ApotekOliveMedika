<?php

namespace App\Http\Repositories;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PromoRepository
{

	public function getPromoById(int $id): ?Promo
	{
		$row = DB::table('promos')->where('id', $id)->where('soft_deleted', false)->first();
		if (!$row) {
			return null;
		}
		return new Promo(
			$row->id,
			$row->id_barang,
			$row->harga_promo_per_unit,
			Carbon::parse($row->tanggal_mulai),
			Carbon::parse($row->tanggal_berakhir),
			Carbon::parse($row->created_at),
		);
	}

	public function getActivePromoByIdBarang(int $id_barang): ?array
	{
		$current_time_string = Carbon::now()->format('Y-m-d h:i:s');
		$rows = DB::table('promos')
			->where('id_barang', $id_barang)
			->where('soft_deleted', false)
			->where('tanggal_mulai', '>=', $current_time_string)
			->where('tanggal_berakhir', '<=', $current_time_string)
			->orderBy('harga_per_unit')
			->get();

		if (!$rows) {
			return null;
		}

		/** @var Promo[] $promos */
		$promos = [];
		foreach ($rows as $row) {
			$promos[] = new Promo(
				$row->id,
				$row->id_barang,
				$row->harga_promo_per_unit,
				Carbon::parse($row->tanggal_mulai),
				Carbon::parse($row->tanggal_berakhir),
				Carbon::parse($row->created_at),
			);
		}

		return $promos;
	}

	/**
	 * Get all promo except deleted promo
	 * @return Promo[]|null
	 */
	public function getAllPromo(): ?array
	{
		$rows = DB::table('promos')->where('soft_deleted', false)->get();
		if (!$rows) {
			return null;
		}

		/** @var Promo[] $promos */
		$promos = [];
		foreach ($rows as $row) {
			$promos[] = new Promo(
				$row->id,
				$row->id_barang,
				$row->harga_promo_per_unit,
				Carbon::parse($row->tanggal_mulai),
				Carbon::parse($row->tanggal_berakhir),
				Carbon::parse($row->created_at),
			);
		}

		return $promos;
	}

	public function persist(Promo $promo)
	{
		$current_time = Carbon::now();
		if ($promo->getId()) {
			//Update
			DB::table('promos')->updateOrInsert(
				[
					'id' => $promo->getId()
				],
				[
					'id_barang' => $promo->getIdBarang(),
					'harga_promo_per_unit' => $promo->getHargaPromoPerUnit(),
					'tanggal_mulai' => $promo->getTanggalMulai(),
					'tanggal_berakhir' => $promo->getTanggalBerakhir(),
					'updated_at' => $current_time,
				]
			);
		} else {
			//Create
			DB::table('promos')->insert(
				[
					'id_barang' => $promo->getIdBarang(),
					'harga_promo_per_unit' => $promo->getHargaPromoPerUnit(),
					'tanggal_mulai' => $promo->getTanggalMulai(),
					'tanggal_berakhir' => $promo->getTanggalBerakhir(),
					'created_at' => $current_time,
					'updated_at' => $current_time,
				]
			);
		}
	}

	public function delete(int $id)
	{
		DB::table('promos')->where('id', $id)->delete();
	}
}
