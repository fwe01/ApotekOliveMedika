<?php

namespace App\Http\Repositories;

use App\Exceptions\OliveMedikaException;
use App\Models\Barang;
use App\Models\TypeBarang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BarangRepository
{
    /**
     * @return Barang[]|null
     * @throws OliveMedikaException
     */
    public function getAllBarang(): ?array
    {
        $rows = DB::table('barangs')
            ->where('soft_deleted', false)
            ->get();

        if (!$rows) {
            return null;
        }

        return $this->buildBarangFromRows($rows);
    }

    /**
     * @param Collection $rows
     * @return Barang[]
     * @throws OliveMedikaException
     */
    private function buildBarangFromRows(Collection $rows): array
    {
        /** @var Barang[] $barangs */
        $barangs = [];
        foreach ($rows as $row) {
            $barangs[] = new Barang(
                $row->id,
                $row->nama,
                $row->harga,
                $row->stock,
                $row->gambar,
                new TypeBarang($row->type),
                $row->is_generic,
            );
        }
        return $barangs;
    }

    /**
     * @return Barang[]|null
     * @throws OliveMedikaException
     */
    public function getBarangGeneric(): ?array
    {
        $rows = DB::table('barangs')
            ->where('soft_deleted', false)
            ->where('is_generic', true)
            ->get();

        if (!$rows) {
            return null;
        }

        return $this->buildBarangFromRows($rows);
    }

    public function persist(Barang $barang)
    {
        $current_time = Carbon::now();
        if ($barang->getId()) {
            //Update
            DB::table('barangs')->updateOrInsert(
                [
                    'id' => $barang->getId()
                ],
                [
                    'nama' => $barang->getNama(),
                    'harga' => $barang->getHarga(),
                    'stock' => $barang->getStock(),
                    'is_generic' => $barang->isGeneric(),
                    'type' => $barang->getType()->getValue(),
                    'gambar' => $barang->getGambar(),
                    'updated_at' => $current_time,
                ]
            );
        } else {
            //Create
            DB::table('barangs')->insert(
                [
                    'nama' => $barang->getNama(),
                    'harga' => $barang->getHarga(),
                    'stock' => $barang->getStock(),
                    'is_generic' => $barang->isGeneric(),
                    'type' => $barang->getType()->getValue(),
                    'gambar' => $barang->getGambar(),
                    'created_at' => $current_time,
                    'updated_at' => $current_time,
                ]
            );
        }
    }

    /**
     * @param int[] $ids
     * @return Barang[] |null
     * @throws OliveMedikaException
     */
    public function getBarangBulk(array $ids): ?array
    {
        $rows = DB::table('barangs')
            ->where('soft_deleted', false)
            ->whereIn('id', $ids)
            ->get();

        if (!$rows) {
            return null;
        }

        $barangs = [];

        foreach ($rows as $row) {
            $barangs [] = new Barang(
                $row->id,
                $row->nama,
                $row->harga,
                $row->stock,
                $row->gambar,
                new TypeBarang($row->type),
                $row->is_generic,
            );
        }
        return $barangs;
    }

    /**
     * @throws OliveMedikaException
     */
    public function getBarangById(int $id): ?Barang
    {
        $row = DB::table('barangs')
            ->where('soft_deleted', false)
            ->where('id', $id)
            ->first();

        if (!$row) {
            return null;
        }

        return new Barang(
            $row->id,
            $row->nama,
            $row->harga,
            $row->stock,
            $row->gambar,
            new TypeBarang($row->type),
            $row->is_generic,
        );
    }

    public function delete(int $id)
    {
        DB::table('barangs')
            ->where('id', $id)
            ->update(
                [
                    'soft_deleted' => true
                ]
            );
    }
}
