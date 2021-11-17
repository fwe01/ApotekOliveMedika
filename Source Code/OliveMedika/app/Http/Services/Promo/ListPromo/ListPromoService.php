<?php

namespace App\Http\Services\Promo\ListPromo;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListPromoService
{
	public function execute(): array
	{
		$promos = $this->getAllPromo();

		$promo_responses = [];
		foreach ($promos as $promo) {
			$promo_responses[] = new ListPromoResponse(
				$promo->id,
				$promo->nama,
				$promo->harga_promo_per_unit,
				Carbon::parse($promo->tanggal_mulai),
				Carbon::parse($promo->tanggal_berakhir),
				Carbon::parse($promo->created_at),
			);
		}
		return $promo_responses;
	}

	private function getAllPromo(): array
	{
		$rows = DB::select(
			'
				select p.id, nama, harga_promo_per_unit, tanggal_mulai, tanggal_berakhir ,p.created_at
				from (select * from promos where soft_deleted = false) p
				join barangs b on p.id_barang = b.id
				order by p.created_at desc 
			',
		);

		return $rows;
	}
}
