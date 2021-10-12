<?php

namespace App\Http\Services\Admin\CreateAdmin;

class CreateAdminRequest
{
	private string $nama;
	private string $alamat;
	private string $no_telp;
	private string $username;
	private string $password;

	/**
	 * @param string $nama
	 * @param string $alamat
	 * @param string $no_telp
	 * @param string $username
	 * @param string $password
	 */
	public function __construct(string $nama, string $alamat, string $no_telp, string $username, string $password)
	{
		$this->nama = $nama;
		$this->alamat = $alamat;
		$this->no_telp = $no_telp;
		$this->username = $username;
		$this->password = $password;
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
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

}