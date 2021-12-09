<?php

namespace App\Http\Services\Laporan\GetLaporan;

use App\Exceptions\OliveMedikaException;
use App\Models\StatusPemesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetLaporanService
{
	/**
	 * @throws OliveMedikaException
	 */
	public function execute(GetLaporanRequest $request): GetLaporanResponse
	{
		return new GetLaporanResponse(
			$this->getTotalPendapatanResponse($request),
			$this->getTotalPengeluaranResponse($request),
			$this->getBarangTerlarisResponse($request),
			$this->getPendapatanResponse($request),
			$this->getPengeluaranResponse($request),
		);
	}

	private function getTotalPendapatanResponse(GetLaporanRequest $request): float
	{
		$pendapatan = DB::select(
				'
				select sum(total) as total
				from pemesanans
				where soft_deleted = false
				  and status = ?
				  and created_at <= ?
				  and created_at > ?
			',
				[
					StatusPemesanan::SELESAI,
					$request->getEndDate()->format('Y-m-d H:i:s'),
					$request->getStartDate()->format('Y-m-d H:i:s')
				]
			)[0]->total ?? 0;

		return $pendapatan;
	}

	private function getTotalPengeluaranResponse(GetLaporanRequest $request)
	{
		$pengeluaran = DB::select(
				'
				select sum(jumlah * harga_per_unit) as total
				from restocks
				where created_at <= ?
				  and created_at > ?
			',
				[
					$request->getEndDate()->format('Y-m-d H:i:s'),
					$request->getStartDate()->format('Y-m-d H:i:s')
				]
			)[0]->total ?? 0;

		return $pengeluaran;
	}

	/**
	 * @throws OliveMedikaException
	 */
	private function getBarangTerlarisResponse(GetLaporanRequest $request): array
	{
		$rows = DB::select(
			'
					select *
					from barangs b
					join (
						select id_barang, sum(bp.quantity) as total_terjual
						from (
							 select id
							 from pemesanans
							 where soft_deleted = false
							 and status = ?
							 and created_at <=  ?
							 and created_at > ?
							 ) p
						join barang_pemesanans bp on p.id = bp.id_pemesanan
						group by bp.id_barang
						limit 10
					) bt on bt.id_barang = b.id
					order by total_terjual desc
			',
			[
				StatusPemesanan::SELESAI,
				$request->getEndDate()->format('Y-m-d H:i:s'),
				$request->getStartDate()->format('Y-m-d H:i:s')
			]
		);

		/** @var BarangTerlaris[] $barang_terlaris */
		$barang_terlaris = [];
		foreach ($rows as $row) {
			$barang_terlaris[] = new BarangTerlaris(
				$row->id,
				$row->nama,
				$row->harga,
				$row->stock,
				$row->gambar,
				$row->type,
				$row->is_generic,
				$row->total_terjual,
			);
		}

		return $barang_terlaris;
	}

	private function getPendapatanResponse(GetLaporanRequest $request)
	{
		$rows = DB::select(
			'
					select p.*, u.name
					from (
						select *
						from pemesanans
						where soft_deleted = false
						  and status = ?
						  and created_at <= ?
						  and created_at > ?
					) p
					join users u on u.id = p.id_user
					order by p.created_at desc
			',
			[
				StatusPemesanan::SELESAI,
				$request->getEndDate()->format('Y-m-d H:i:s'),
				$request->getStartDate()->format('Y-m-d H:i:s')
			]
		);

		/** @var Pendapatan[] $pendapatans */
		$pendapatans = [];
		foreach ($rows as $row) {
			$pendapatans[] = new Pendapatan(
				$row->id,
				$row->id_user,
				$row->total,
				Carbon::parse($row->created_at),
				$row->name
			);
		}

		return $pendapatans;
	}

	private function getPengeluaranResponse(GetLaporanRequest $request)
	{
		$rows = DB::select(
			'
					select r.*, b.nama
					from (
						select *
						from restocks
						where created_at <= ?
						and created_at > ?
					) r join barangs b on b.id = r.id_barang
					order by r.created_at desc
			',
			[
				$request->getEndDate()->format('Y-m-d H:i:s'),
				$request->getStartDate()->format('Y-m-d H:i:s')
			]
		);

		/** @var Pengeluaran[] $pengeluarans */
		$pengeluarans = [];
		foreach ($rows as $row) {
			$pengeluarans[] = new Pengeluaran(
				$row->id,
				$row->id_barang,
				$row->nama,
				$row->username_admin,
				$row->jumlah,
				$row->harga_per_unit,
				Carbon::parse($row->created_at),
			);
		}

		return $pengeluarans;
	}
}
