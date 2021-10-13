<?php

namespace Database\Seeders;

use App\Http\Repositories\AdminRepository;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
	private AdminRepository $repository;

	/**
	 * @param AdminRepository $repository
	 */
	public function __construct(AdminRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$superadmin = Admin::create(
			'superadmin',
			'superadmin',
			Hash::make('12345678'),
			'alamat',
			'081803229999',
		);

		$this->repository->persist($superadmin);
	}
}
