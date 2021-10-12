<?php

namespace App\Http\Services\Admin\DeleteAdmin;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\AdminRepository;

class DeleteAdminService
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
	 * @throws OliveMedikaException
	 */
	public function execute(DeleteAdminRequest $request)
	{
		$admin = $this->repository->getAdminById($request->getId());

		if (!$admin || $admin->getUsername() === 'superadmin') {
			throw OliveMedikaException::build('user-not-found', 2004);
		}

		$this->repository->delete($admin->getId());
	}

}