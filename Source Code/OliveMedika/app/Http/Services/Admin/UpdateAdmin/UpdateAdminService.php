<?php

namespace App\Http\Services\Admin\UpdateAdmin;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\AdminRepository;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UpdateAdminService
{
	private AdminRepository $repository;

	/**
	 * @param AdminRepository $repository
	 */
	public function __construct(AdminRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(UpdateAdminRequest $request)
	{
		$admin = $this->repository->getAdminById($request->getId());

		if (!$admin) {
			throw OliveMedikaException::build('users-not-found', 2001);
		}

		$new_admin = new Admin(
			$admin->getId(),
			$admin->getUsername(),
			$request->getNama(),
			$request->getPassword() ? Hash::make($request->getPassword()) : $admin->getPassword(),
			$request->getAlamat(),
			$request->getNoTelp()
		);

		$this->repository->persist($new_admin);
	}
}