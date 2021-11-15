<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPemesanan extends Model
{
    use HasFactory;

	private ?int $id_pemesanan;
	private int $id_barang;
	private string $nama;
	private float $harga;
	private int $quantity;

	/**
	 * @param int|null $id_pemesanan
	 * @param int $id_barang
	 * @param string $nama
	 * @param float $harga
	 * @param int $quantity
	 */
	public function __construct(
		?int $id_pemesanan,
		int $id_barang,
		string $nama,
		float $harga,
		int $quantity
	) {
		parent::__construct();
		$this->id_pemesanan = $id_pemesanan;
		$this->id_barang = $id_barang;
		$this->nama = $nama;
		$this->harga = $harga;
		$this->stock = $quantity;
	}

	public static function create(
		int $id_barang,
		string $nama,
		float $harga,
		int $quantity
	) {
		return new self(
			null,
			$id_barang,
			$nama,
			$harga,
			$quantity
		);
	}

	/**
	 * @return int
	 */
	public function getIdPemesanan(): int
	{
		return $this->id_pemesanan;
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
	public function getNama(): string
	{
		return $this->nama;
	}

	/**
	 * @return float
	 */
	public function getHarga(): float
	{
		return $this->harga;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}
}
