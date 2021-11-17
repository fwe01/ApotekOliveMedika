<?php

namespace App\Http\Services\Restock\ListRestock;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListRestockService
{
	public function execute(): array
	{
		$rows = DB::select(
			'
				select r.id, id_barang, nama, username_admin, jumlah, harga_per_unit, r.created_at
				from restocks r
				join barangs b on r.id_barang = b.id
				order by r.created_at desc 
			',
		);

		/** @var ListRestockResponse[] $restocks */
		$restocks = [];

		foreach ($rows as $row) {
			$restocks[] = new ListRestockResponse(
				$row->id_barang,
				$row->nama,
				$row->jumlah,
				$row->harga_per_unit,
				$row->username_admin,
				Carbon::parse($row->created_at),
			);
		}

		return $restocks;
	}
}
