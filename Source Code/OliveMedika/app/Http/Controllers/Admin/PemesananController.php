<?php

namespace App\Http\Controllers\Admin;

use App\Http\Mechanism\UnitOfWork;
use App\Http\Services\Barang\ListBarang\ListBarangOptions;
use App\Http\Services\Barang\ListBarang\ListBarangRequest;
use App\Http\Services\Barang\ListBarang\ListBarangService;
use App\Http\Services\Pemesanan\CancelPemesanan\CancelPemesananRequest;
use App\Http\Services\Pemesanan\CancelPemesanan\CancelPemesananService;
use App\Http\Services\Pemesanan\CreatePemesanan\BarangPemesanan;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananRequest;
use App\Http\Services\Pemesanan\CreatePemesanan\CreatePemesananService;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananRequest;
use App\Http\Services\Pemesanan\DeletePemesanan\DeletePemesananService;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananRequest;
use App\Http\Services\Pemesanan\FindPemesanan\FindPemesananService;
use App\Http\Services\Pemesanan\FinishPemesanan\FinishPemesananRequest;
use App\Http\Services\Pemesanan\FinishPemesanan\FinishPemesananService;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananRequest;
use App\Http\Services\Pemesanan\ListPemesanan\ListPemesananService;
use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PemesananController
{
	private UnitOfWork $unit_of_work;

	/**
	 * @param UnitOfWork $unit_of_work
	 */
	public function __construct(UnitOfWork $unit_of_work)
	{
		$this->unit_of_work = $unit_of_work;
	}

	public function index()
	{
		$input = new ListPemesananRequest(
			new UserType(UserType::ADMIN),
			0
		);
		/** @var ListPemesananService $service */
		$service = resolve(ListPemesananService::class);
		$pemesanans = $service->execute($input);

		$input = new ListBarangRequest(new ListBarangOptions(ListBarangOptions::ALL));
		/** @var ListBarangService $service */
		$service = resolve(ListBarangService::class);
		$barangs = $service->execute($input);

		$users = User::get(['id', 'name']);

		return view('admin.pemesanans.index', compact('pemesanans', 'barangs', 'users'));
	}

	public function delete(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new DeletePemesananRequest($request->input('id'), new UserType(UserType::ADMIN), 0);
		/** @var DeletePemesananService $service */
		$service = resolve(DeletePemesananService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menghapus pemesanan');
		}
		return redirect()->back()->with('success', 'Pemesanan berhasil dihapus');
	}

	public function detail(int $id)
	{
		$input = new FindPemesananRequest($id, new UserType(UserType::ADMIN), 0);
		/** @var FindPemesananService $service */
		$service = resolve(FindPemesananService::class);
		$pemesanan = $service->execute($input);

		return view('admin.pemesanans.detail', compact('pemesanan'));
	}

	public function cancel(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new CancelPemesananRequest($request->input('id'), new UserType(UserType::ADMIN), 0);
		/** @var CancelPemesananService $service */
		$service = resolve(CancelPemesananService::class);

		$this->unit_of_work->begin();
		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal membatalkan pemesanan');
		}
		$this->unit_of_work->commit();
		return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan');
	}

	public function finish(Request $request): RedirectResponse
	{
		$request->validate(
			[
				'id' => 'required'
			]
		);

		$input = new FinishPemesananRequest($request->input('id'));
		/** @var FinishPemesananService $service */
		$service = resolve(FinishPemesananService::class);

		try {
			$service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal menyelesaikan pemesanan');
		}
		return redirect()->back()->with('success', 'Pemesanan berhasil diselesaikan');
	}

	public function add(Request $request)
	{
		$request->validate(
			[
				'user_id' => 'required',
				'id' => 'required',
				'jumlah' => 'required'
			]
		);

		$id = $request->input('id');
		$jumlah = $request->input('jumlah');

		/** @var BarangPemesanan $barangs */
		$barangs = [];
		for ($barang = 0; $barang < count($id); $barang++) {
			$barangs[] = new BarangPemesanan(
				$id[$barang],
				$jumlah[$barang]
			);
		}

		$input = new CreatePemesananRequest(
			$request->input('user_id'),
			$barangs
		);

		/** @var CreatePemesananService $service */
		$service = resolve(CreatePemesananService::class);

		$this->unit_of_work->begin();
		try {
			$response = $service->execute($input);
		} catch (Exception $e) {
			return redirect()->back()->with('alert', 'Gagal membuat pemesanan');
		}
		$this->unit_of_work->commit();
		return redirect()->route('admin.pemesanans.detail', ['id' => $response->getId()])
			->with('success', 'Pemesanan berhasil dibuat');
	}
}
