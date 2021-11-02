<?php

namespace App\Http\Services\Resep\ListResep;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListResepService
{
	public function execute(ListResepRequest $request): array
	{
		$rows = [];
		switch ($request->getOptions()->getValue()) {
			case ListResepOptions::ADMIN:
				$rows = $this->getAdminRows();
				break;
			case ListResepOptions::USER:
				$rows = $this->getUserRows($request->getIdUser());
				break;
		}
		return $this->buildResponseFromRows($rows);
	}

	private function getAdminRows(): array
	{
		return DB::select(
			'
			select name,
				   r.id,
				   r.id_user,
				   r.gambar,
				   r.status,
				   r.keterangan,
				   r.soft_deleted,
				   r.created_at,
				   r.updated_at
			from reseps r
					 join users u on r.id_user = u.id
			where r.soft_deleted = false;
		'
		);
	}

	private function getUserRows(int $id_user): array
	{
		return DB::select(
			'
				select name,
					   r.id,
					   r.id_user,
					   r.gambar,
					   r.status,
					   r.keterangan,
					   r.soft_deleted,
					   r.created_at,
					   r.updated_at
				from reseps r
						 join users u on r.id_user = u.id
				where r.soft_deleted = false
				and r.id_user = ?;
			',
			[
				$id_user
			]
		);
	}

	private function buildResponseFromRows(array $rows): array
	{
		/** @var ListResepResponse[] $reseps */
		$reseps = [];
		foreach ($rows as $row) {
			$reseps[] = new ListResepResponse(
				$row->id,
				$row->name,
				$row->id_user,
				$row->gambar,
				$row->status,
				Carbon::parse($row->created_at),
				$row->keterangan,
			);
		}
		return $reseps;
	}
}