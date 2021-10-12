<?php

namespace App\Http\Services\Admin\ListAdmin;

class ListAdminResponse
{
	private string $nama;
	private string $username;
	private string $alamat;
	private string $no_telp;
	private int $id;

	/**
	 * @param int $id
	 * @param string $nama
	 * @param string $username
	 * @param string $alamat
	 * @param string $no_telp
	 */
	public function __construct(int $id, string $nama, string $username, string $alamat, string $no_telp)
	{
		$this->nama = $nama;
		$this->username = $username;
		$this->alamat = $alamat;
		$this->no_telp = $no_telp;
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId(): int
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
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
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