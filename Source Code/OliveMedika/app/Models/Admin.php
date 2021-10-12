<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	use HasFactory;

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
		'remember_token',
	];

	private ?int $id;
	private string $username;
	private string $nama;
	private string $password;
	private string $alamat;
	private string $no_telp;

	/**
	 * @param int|null $id
	 * @param string $username
	 * @param string $nama
	 * @param string $password
	 * @param string $alamat
	 * @param string $no_telp
	 */
	public function __construct(
		?int $id,
		string $username,
		string $nama,
		string $password,
		string $alamat,
		string $no_telp
	) {
		parent::__construct();
		$this->id = $id;
		$this->username = $username;
		$this->nama = $nama;
		$this->password = $password;
		$this->alamat = $alamat;
		$this->no_telp = $no_telp;
	}

	static public function create(
		string $username,
		string $nama,
		string $password,
		string $alamat,
		string $no_telp
	): Admin {
		return new self(
			null,
			$username,
			$nama,
			$password,
			$alamat,
			$no_telp
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

	/**
	 * Overrides the method to ignore the remember token.
	 */
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute) {
			parent::setAttribute($key, $value);
		}
	}
}
