<?php

namespace App\Http\Services\Pemesanan\ListPemesanan;

use App\Exceptions\OliveMedikaException;
use App\Http\Repositories\PemesananRepository;
use App\Models\StatusPemesanan;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListPemesananService
{
    private PemesananRepository $repository;

    /**
     * @param PemesananRepository $repository
     */
    public function __construct(PemesananRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws OliveMedikaException
     */
    public function execute(ListPemesananRequest $request)
    {
        switch ($request->getUserType()->getValue()) {
            case UserType::USER:
                return $this->getUserResponse($request->getIdUser());
            case UserType::ADMIN:
                return $this->getAdminResponse();
        }
    }

    private function getUserResponse(int $id_user): array
    {
        $pemesanans = DB::select(
            '
			select p.*, u.name
			from (select * from pemesanans where soft_deleted = false and id_user = ?) p
			join users u on u.id = p.id_user
			order by p.created_at desc
		',
            [
                $id_user
            ]
        );
        return $this->buildResponseFromPemesanans($pemesanans);
    }

    private function buildResponseFromPemesanans(array $pemesanans): array
    {
        $response = [];
        foreach ($pemesanans as $pemesanan) {
            $response[] = new ListPemesananResponse(
                $pemesanan->id,
                $pemesanan->id_user,
                $pemesanan->name,
                $pemesanan->total,
                Carbon::parse($pemesanan->created_at),
                new StatusPemesanan($pemesanan->status),
            );
        }
        return $response;
    }

    private function getAdminResponse(): array
    {
        $pemesanans = DB::select(
            '
			select p.*, u.name
			from (select * from pemesanans where soft_deleted = false) p
			join users u on u.id = p.id_user
		'
        );
        return $this->buildResponseFromPemesanans($pemesanans);
    }
}
