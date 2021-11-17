<?php

namespace App\Http\Services\Laporan\GetLaporan;

class GetLaporanResponse
{
	private float $total_pendapatan;
	private float $total_pengeluaran;
	/** @var BarangTerlaris[] $barang_terlaris */
	private array $barang_terlaris;
	/** @var Pendapatan[] $pendapatan */
	private array $pendapatan;
	/** @var Pengeluaran[] $pengeluaran */
	private array $pengeluaran;

	/**
	 * @param float $total_pendapatan
	 * @param float $total_pengeluaran
	 * @param BarangTerlaris[] $barang_terlaris
	 * @param Pendapatan[] $pendapatan
	 * @param Pengeluaran[] $pengeluaran
	 */
	public function __construct(
		float $total_pendapatan,
		float $total_pengeluaran,
		array $barang_terlaris,
		array $pendapatan,
		array $pengeluaran
	) {
		$this->total_pendapatan = $total_pendapatan;
		$this->total_pengeluaran = $total_pengeluaran;
		$this->barang_terlaris = $barang_terlaris;
		$this->pendapatan = $pendapatan;
		$this->pengeluaran = $pengeluaran;
	}

	/**
	 * @return float
	 */
	public function getTotalPendapatan(): float
	{
		return $this->total_pendapatan;
	}

	/**
	 * @return float
	 */
	public function getTotalPengeluaran(): float
	{
		return $this->total_pengeluaran;
	}

	/**
	 * @return BarangTerlaris[]
	 */
	public function getBarangTerlaris(): array
	{
		return $this->barang_terlaris;
	}

	/**
	 * @return Pendapatan[]
	 */
	public function getPendapatan(): array
	{
		return $this->pendapatan;
	}

	/**
	 * @return Pengeluaran[]
	 */
	public function getPengeluaran(): array
	{
		return $this->pengeluaran;
	}


}
