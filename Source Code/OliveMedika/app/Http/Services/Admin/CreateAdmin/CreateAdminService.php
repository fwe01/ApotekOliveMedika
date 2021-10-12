<?php

namespace App\Http\Services\Admin\CreateAdmin;

use App\Http\Repositories\AdminRepository;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminService
{
	private AdminRepository $repository;

	/**
	 * @param AdminRepository $repository
	 */
	public function __construct(AdminRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(CreateAdminRequest $request)
	{
		$admin = Admin::create(
			$request->getUsername(),
			$request->getNama(),
			Hash::make($request->getPassword()),
			$request->getAlamat(),
			$request->getNoTelp(),
		);

		$this->repository->persist($admin);
	}
}