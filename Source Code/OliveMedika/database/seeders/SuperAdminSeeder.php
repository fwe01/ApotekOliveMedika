<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Admin::create(
			[
				'username' => 'superadmin',
				'password' => Hash::make('12345678'),
				'alamat' => 'alamat',
				'no_telp' => '081803229999',
				'nama' => 'superadmin',
			]
		);
	}
}
