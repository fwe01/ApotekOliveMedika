<?php

namespace App\Http\Services\FullDetailPromo;

use Illuminate\Support\Facades\DB;

class FullDetailPromoService
{
    public function execute()
    {
        $detail_promo_rows = DB::select("
            select promos . harga_promo_per_unit, b . nama, b . harga, b . stock, b . gambar
            from promos
                left join barangs b on promos . id_barang = b . id
         ");

        /** @var FullDetailPromoResponse[] $full_detail_promo */
        $full_detail_promo = [];
        foreach ($detail_promo_rows as $detail_promo_row) {
            $full_detail_promo[] = new FullDetailPromoResponse(
                $detail_promo_row->nama,
                $detail_promo_row->harga,
                $detail_promo_row->harga_promo_per_unit,
                $detail_promo_row->stock,
                $detail_promo_row->gambar,
            );
        }

        return $full_detail_promo;
    }
}
