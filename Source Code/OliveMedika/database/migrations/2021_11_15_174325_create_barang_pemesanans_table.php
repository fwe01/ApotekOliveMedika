<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_pemesanans', function (Blueprint $table) {
			$table->unsignedBigInteger('id_pemesanan');
			$table->unsignedBigInteger('id_barang');
			$table->string('nama');
			$table->float('harga', 16, 2);
			$table->unsignedBigInteger('quantity');
			$table->foreign('id_pemesanan')->references('id')->on('pemesanans');
			$table->foreign('id_barang')->references('id')->on('barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_pemesanans');
    }
}
