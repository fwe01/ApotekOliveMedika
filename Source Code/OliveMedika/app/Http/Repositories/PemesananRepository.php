<?php

namespace App\Http\Repositories;

use App\Exceptions\OliveMedikaException;
use App\Models\BarangPemesanan;
use App\Models\Pemesanan;
use App\Models\StatusPemesanan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PemesananRepository
{
    /**
     * @return Pemesanan[]|null
     * @throws OliveMedikaException
     */
    public function getAllPemesananWithoutBarang(?int $id_user = null): ?array
    {
        if ($id_user == null) {
            $rows = DB::table('pemesanans')
                ->where('soft_deleted', false)
                ->get();
        } else {
            $rows = DB::table('pemesanans')
                ->where('id_user', $id_user)
                ->where('soft_deleted', false)
                ->get();
        }

        if (!$rows) {
            return null;
        }

        return $this->buildPemesananWithoutBarangFromRows($rows);
    }

    /**
     * @param Collection $rows
     * @return Pemesanan[]
     * @throws OliveMedikaException
     */
    private function buildPemesananWithoutBarangFromRows(Collection $rows): array
    {
        /** @var Pemesanan[] $pemesanans */
        $pemesanans = [];
        foreach ($rows as $row) {
            $pemesanans[] = new Pemesanan(
                $row->id,
                $row->id_user,
                [],
                $row->total,
                Carbon::parse($row->created_at),
                new StatusPemesanan($row->status),
            );
        }
        return $pemesanans;
    }

    /**
     * @return Pemesanan[]|null
     * @throws OliveMedikaException
     */
    public function getPemesananGeneric(): ?array
    {
        $rows = DB::table('pemesanans')
            ->where('soft_deleted', false)
            ->where('is_generic', true)
            ->get();

        if (!$rows) {
            return null;
        }

        return $this->buildPemesananWithoutBarangFromRows($rows);
    }

    /**
     * @throws OliveMedikaException
     */
    public function persist(Pemesanan $pemesanan)
    {
        $current_time = Carbon::now();
        if ($pemesanan->getId()) {
            throw OliveMedikaException::build('pemesanan-not-editable', 2014);
        } else {
            //Create
            $id_pemesanan = DB::table('pemesanans')->insertGetId(
                [
                    'id_user' => $pemesanan->getIdUser(),
                    'total' => $pemesanan->getTotal(),
                    'created_at' => $current_time,
                    'updated_at' => $current_time,
                    'status' => $pemesanan->getStatus()->getValue(),
                ]
            );

            $barang_pemesanan_payload = $this->createBarangPemesananPayload($pemesanan->getBarangs(), $id_pemesanan);

            DB::table('barang_pemesanans')->insert($barang_pemesanan_payload);
        }
    }

    /**
     * @param BarangPemesanan[] $barangs
     * @param int $id_pemesanan
     * @return array
     */
    private function createBarangPemesananPayload(array $barangs, int $id_pemesanan): array
    {
        $payload = [];
        foreach ($barangs as $barang) {
            $payload[] = [
                'id_pemesanan' => $id_pemesanan,
                'id_barang' => $barang->getIdBarang(),
                'nama' => $barang->getNama(),
                'harga' => $barang->getHarga(),
                'quantity' => $barang->getQuantity(),
            ];
        }
        return $payload;
    }

    /**
     * @throws OliveMedikaException
     */
    public function getPemesananById(int $id): ?Pemesanan
    {
        $row = DB::table('pemesanans')
            ->where('soft_deleted', false)
            ->where('id', $id)
            ->first();

        if (!$row) {
            return null;
        }

        $barang_rows = DB::table('barang_pemesanans')->where('id_pemesanan', $id)->get();
        $barang_pemesanan = $this->buildBarangPemesananFromRows($barang_rows);

        return new Pemesanan(
            $row->id,
            $row->id_user,
            $barang_pemesanan,
            $row->total,
            Carbon::parse($row->created_at),
            new StatusPemesanan($row->status)
        );
    }

    /**
     * @param Collection $barang_rows
     * @return BarangPemesanan[]
     */
    private function buildBarangPemesananFromRows(Collection $barang_rows): array
    {
        $barang_pemesanan = [];
        foreach ($barang_rows as $barang_row) {
            $barang_pemesanan[] = new BarangPemesanan(
                $barang_row->id_pemesanan,
                $barang_row->id_barang,
                $barang_row->nama,
                $barang_row->harga,
                $barang_row->quantity,
            );
        }
        return $barang_pemesanan;
    }

    public function delete(int $id)
    {
        DB::table('pemesanans')
            ->where('id', $id)
            ->update(
                [
                    'soft_deleted' => true
                ]
            );
    }
}
