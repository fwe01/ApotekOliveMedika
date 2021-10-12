<?php

namespace App\Http\Services\Admin\UpdateAdmin;

class UpdateAdminRequest
{
	private string $nama;
	private string $alamat;
	private string $no_telp;
	private ?string $password;
	private int $id;

	/**
	 * @param int $id
	 * @param string $nama
	 * @param string $alamat
	 * @param string $no_telp
	 * @param string|null $password
	 */
	public function __construct(int $id, string $nama, string $alamat, string $no_telp, ?string $password)
	{
		$this->nama = $nama;
		$this->alamat = $alamat;
		$this->no_telp = $no_telp;
		$this->password = $password;
		$this->id = $id;
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
	 * @return string|null
	 */
	public function getPassword(): ?string
	{
		return $this->password;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
}