<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

	private ?int $id;
	private string $username;
	private string $nama;
	private string $password;
	private string $alamat;
	private string $no_telp;

	protected $table = 'admins';

	protected $fillable = [
		'username',
		'password',
		'alamat',
		'no-telp',
		'nama'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

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
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getNama(): string
	{
		return $this->nama;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getAlamat(): string
	{
		return $this->alamat;
	}

	/**
	 * @return string
	 */
	public function getNoTelp(): string
	{
		return $this->no_telp;
	}
}
