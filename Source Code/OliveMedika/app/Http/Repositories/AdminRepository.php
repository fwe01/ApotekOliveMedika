<?php

namespace App\Http\Repositories;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminRepository
{
	public function getAdminById(int $id): ?Admin
	{
		$row = DB::table('admins')->where('id', $id)->first();
		if (!$row) {
			return null;
		}
		return new Admin(
			$row->id,
			$row->username,
			$row->nama,
			$row->password,
			$row->alamat,
			$row->no_telp,
		);
	}

	public function getAdminByUsername(string $username): ?Admin
	{
		$row = DB::table('admins')->whereRaw('BINARY username = ?', [$username])->first();
		if (!$row) {
			return null;
		}
		return new Admin(
			$row->id,
			$row->username,
			$row->nama,
			$row->password,
			$row->alamat,
			$row->no_telp,
		);
	}

	/**
	 * Get all admin except superadmin
	 * @return Admin[]|null
	 */
	public function getAllAdmin(): ?array
	{
		$rows = DB::table('admins')->whereNotIn('username', ['superadmin'])->get();
		if (!$rows) {
			return null;
		}

		/** @var Admin[] $admins */
		$admins = [];
		foreach ($rows as $row) {
			$admins[] = new Admin(
				$row->id,
				$row->username,
				$row->nama,
				$row->password,
				$row->alamat,
				$row->no_telp,
			);
		}
		return $admins;
	}

	public function persist(Admin $admin)
	{
		$current_time = Carbon::now();
		if ($admin->getId()) {
			//Update
			DB::table('admins')->updateOrInsert(
				[
					'id' => $admin->getId()
				],
				[
					'nama' => $admin->getNama(),
					'username' => $admin->getUsername(),
					'password' => $admin->getPassword(),
					'no_telp' => $admin->getNoTelp(),
					'alamat' => $admin->getAlamat(),
					'updated_at' => $current_time,
				]
			);
		} else {
			//Create
			DB::table('admins')->insert(
				[
					'nama' => $admin->getNama(),
					'username' => $admin->getUsername(),
					'password' => $admin->getPassword(),
					'no_telp' => $admin->getNoTelp(),
					'alamat' => $admin->getAlamat(),
					'created_at' => $current_time,
					'updated_at' => $current_time,
				]
			);
		}
	}

	public function delete(int $id)
	{
		DB::table('admins')->where('id', $id)->delete();
	}
}