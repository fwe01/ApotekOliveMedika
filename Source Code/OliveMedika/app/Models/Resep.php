<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
	use HasFactory;

	private ?int $id;
	private int $id_user;
	private string $gambar;
	private ?string $keterangan;
	private StatusResep $status;
	private Carbon $created_at;

	/**
	 * @param int|null $id
	 * @param int $id_user
	 * @param string $gambar
	 * @param string|null $keterangan
	 * @param StatusResep $status
	 * @param Carbon $created_at
	 */
	public function __construct(
		?int $id,
		int $id_user,
		string $gambar,
		?string $keterangan,
		StatusResep $status,
		Carbon $created_at
	) {
		parent::__construct();
		$this->id = $id;
		$this->id_user = $id_user;
		$this->gambar = $gambar;
		$this->keterangan = $keterangan;
		$this->status = $status;
		$this->created_at = $created_at;
	}

	/**
	 * @param int $id_user
	 * @param string $gambar
	 * @param string|null $keterangan
	 * @param StatusResep $status
	 * @return Resep
	 */
	public static function create(
		int $id_user,
		string $gambar,
		?string $keterangan,
		StatusResep $status
	): Resep {
		return new self(
			null,
			$id_user,
			$gambar,
			$keterangan,
			$status,
			Carbon::now()
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
	public function getIdUser(): int
	{
		return $this->id_user;
	}

	/**
	 * @return string
	 */
	public function getGambar(): string
	{
		return $this->gambar;
	}

	/**
	 * @return string|null
	 */
	public function getKeterangan(): ?string
	{
		return $this->keterangan;
	}

	/**
	 * @return StatusResep
	 */
	public function getStatus(): StatusResep
	{
		return $this->status;
	}

	/**
	 * @return Carbon
	 */
	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}
}
