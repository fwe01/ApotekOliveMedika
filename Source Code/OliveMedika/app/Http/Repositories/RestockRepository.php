<?php

namespace App\Http\Repositories;

use App\Models\Restock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RestockRepository
{
	public function persist(Restock $restock)
	{
		$current_time = Carbon::now();
		if ($restock->getId()) {
			//Update
			DB::table('restocks')->updateOrInsert(
				[
					'id' => $restock->getId()
				],
				[
					'id_barang' => $restock->getIdBarang(),
					'username_admin' => $restock->getUsernameAdmin(),
					'jumlah' => $restock->getJumlah(),
					'harga_per_unit' => $restock->getHargaPerUnit(),
					'updated_at' => $current_time,
				]
			);
		} else {
			//Create
			DB::table('restocks')->insert(
				[
					'id_barang' => $restock->getIdBarang(),
					'username_admin' => $restock->getUsernameAdmin(),
					'jumlah' => $restock->getJumlah(),
					'harga_per_unit' => $restock->getHargaPerUnit(),
					'created_at' => $restock->getCreatedAt(),
					'updated_at' => $restock->getCreatedAt(),
				]
			);
		}
	}
}