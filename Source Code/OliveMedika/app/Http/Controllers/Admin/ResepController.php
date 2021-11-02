<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\OliveMedikaException;
use App\Http\Services\Resep\ListResep\ListResepOptions;
use App\Http\Services\Resep\ListResep\ListResepRequest;
use App\Http\Services\Resep\ListResep\ListResepService;

class ResepController
{
	/**
	 * @throws OliveMedikaException
	 */
	public function index()
	{
		$input = new ListResepRequest(new ListResepOptions(ListResepOptions::ADMIN));

		/** @var ListResepService $service */
		$service = resolve(ListResepService::class);
		$reseps = $service->execute($input);

		return view('admin.reseps.index', compact('reseps'));
	}
}