<?php

namespace App\Http\Repositories;

use App\Models\Barang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BarangRepository
{
	public function persist(Barang $barang)
	{
		$current_time = Carbon::now();
		if ($barang->getId()) {
			//Update
			DB::table('barangs')->updateOrInsert(
				[
					'id' => $barang->getId()
				],
				[
					'nama' => $barang->getNama(),
					'harga' => $barang->getHarga(),
					'stock' => $barang->getStock(),
					'is_generic' => $barang->isGeneric(),
					'type' => $barang->getType()->getValue(),
					'gambar' => $barang->getGambar(),
					'updated_at' => $current_time,
				]
			);
		} else {
			//Create
			DB::table('barangs')->insert(
				[
					'nama' => $barang->getNama(),
					'harga' => $barang->getHarga(),
					'stock' => $barang->getStock(),
					'is_generic' => $barang->isGeneric(),
					'type' => $barang->getType()->getValue(),
					'gambar' => $barang->getGambar(),
					'created_at' => $current_time,
					'updated_at' => $current_time,
				]
			);
		}
	}
}