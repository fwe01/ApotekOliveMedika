<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
	use HasFactory;

	private ?int $id;
	private int $id_barang;
	private float $harga_promo_per_unit;
	private Carbon $tanggal_mulai;
	private Carbon $tanggal_berakhir;
	private Carbon $created_at;


	/**
	 * @param int|null $id
	 * @param int $id_barang
	 * @param float $harga_promo_per_unit
	 * @param Carbon $tanggal_mulai
	 * @param Carbon $tanggal_berakhir
	 * @param Carbon $created_at
	 */
	public function __construct(
		?int $id,
		int $id_barang,
		float $harga_promo_per_unit,
		Carbon $tanggal_mulai,
		Carbon $tanggal_berakhir,
		Carbon $created_at
	) {
		parent::__construct();
		$this->id = $id;
		$this->id_barang = $id_barang;
		$this->harga_promo_per_unit = $harga_promo_per_unit;
		$this->tanggal_mulai = $tanggal_mulai;
		$this->tanggal_berakhir = $tanggal_berakhir;
		$this->created_at = $created_at;
	}

	static public function create(
		int $id_barang,
		float $harga_promo_per_unit,
		Carbon $tanggal_mulai,
		Carbon $tanggal_berakhir
	): Promo {
		return new self(
			null,
			$id_barang,
			$harga_promo_per_unit,
			$tanggal_mulai,
			$tanggal_berakhir,
			Carbon::now(),
		);
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getIdBarang(): int
	{
		return $this->id_barang;
	}

	/**
	 * @return float
	 */
	public function getHargaPromoPerUnit(): float
	{
		return $this->harga_promo_per_unit;
	}

	/**
	 * @return Carbon
	 */
	public function getTanggalMulai(): Carbon
	{
		return $this->tanggal_mulai;
	}

	/**
	 * @return Carbon
	 */
	public function getTanggalBerakhir(): Carbon
	{
		return $this->tanggal_berakhir;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}
}
