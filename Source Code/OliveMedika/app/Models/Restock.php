<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
	use HasFactory;

	private ?int $id;
	private int $id_barang;
	private string $username_admin;
	private int $jumlah;
	private float $harga_per_unit;
	private Carbon $created_at;

	/**
	 * @param int|null $id
	 * @param int $id_barang
	 * @param string $username_admin
	 * @param int $jumlah
	 * @param float $harga_per_unit
	 * @param Carbon $created_at
	 */
	public function __construct(
		?int $id,
		int $id_barang,
		string $username_admin,
		int $jumlah,
		float $harga_per_unit,
		Carbon $created_at
	) {
		parent::__construct();
		$this->id = $id;
		$this->id_barang = $id_barang;
		$this->username_admin = $username_admin;
		$this->jumlah = $jumlah;
		$this->harga_per_unit = $harga_per_unit;
		$this->created_at = $created_at;
	}

	static public function create(int $id_barang, string $username_admin, int $jumlah, float $harga_per_unit): Restock
	{
		return new self(
			null,
			$id_barang,
			$username_admin,
			$jumlah,
			$harga_per_unit,
			Carbon::now(),
		);
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
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
	 * @return string
	 */
	public function getUsernameAdmin(): string
	{
		return $this->username_admin;
	}

	/**
	 * @return int
	 */
	public function getJumlah(): int
	{
		return $this->jumlah;
	}

	/**
	 * @return float
	 */
	public function getHargaPerUnit(): float
	{
		return $this->harga_per_unit;
	}
}
