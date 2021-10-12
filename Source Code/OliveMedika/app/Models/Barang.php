<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	use HasFactory;

	protected $table = 'barangs';

	private ?int $id;
	private string $nama;
	private float $harga;
	private int $stock;
	private string $gambar;
	private TypeBarang $type;
	private bool $is_generic;

	/**
	 * @param int|null $id
	 * @param string $nama
	 * @param float $harga
	 * @param int $stock
	 * @param string $gambar
	 * @param TypeBarang $type
	 * @param bool $is_generic
	 */
	public function __construct(
		?int $id,
		string $nama,
		float $harga,
		int $stock,
		string $gambar,
		TypeBarang $type,
		bool $is_generic
	) {
		parent::__construct();
		$this->id = $id;
		$this->nama = $nama;
		$this->harga = $harga;
		$this->stock = $stock;
		$this->gambar = $gambar;
		$this->type = $type;
		$this->is_generic = $is_generic;
	}

	/**
	 * @param string $nama
	 * @param float $harga
	 * @param int $stock
	 * @param string $gambar
	 * @param TypeBarang $type
	 * @param bool $is_generic
	 * @return Barang
	 */
	static public function create(
		string $nama,
		float $harga,
		int $stock,
		string $gambar,
		TypeBarang $type,
		bool $is_generic
	): Barang {
		return new self(
			null,
			$nama,
			$harga,
			$stock,
			$gambar,
			$type,
			$is_generic
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
	public function getStock(): int
	{
		return $this->stock;
	}

	/**
	 * @return string
	 */
	public function getGambar(): string
	{
		return $this->gambar;
	}

	/**
	 * @return TypeBarang
	 */
	public function getType(): TypeBarang
	{
		return $this->type;
	}

	/**
	 * @return bool
	 */
	public function isGeneric(): bool
	{
		return $this->is_generic;
	}
}
