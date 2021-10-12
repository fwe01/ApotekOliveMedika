<?php

namespace App\Http\Services\Admin\ListAdmin;

use App\Http\Repositories\AdminRepository;

class ListAdminService
{
	private AdminRepository $repository;

	/**
	 * @param AdminRepository $repository
	 */
	public function __construct(AdminRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(): array
	{
		/** @var ListAdminResponse[] $admin_response */
		$admin_response = [];
		$admins = $this->repository->getAllAdmin();
		foreach ($admins as $admin) {
			$admin_response[] = new ListAdminResponse(
				$admin->getId(),
				$admin->getNama(),
				$admin->getUsername(),
				$admin->getAlamat(),
				$admin->getNoTelp(),
			);
		}
		return $admin_response;
	}
}