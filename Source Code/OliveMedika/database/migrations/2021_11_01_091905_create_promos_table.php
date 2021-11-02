<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promos', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_barang');
			$table->float('harga_promo_per_unit', 16, 2);
			$table->timestamp('tanggal_mulai')->default(Carbon::now());
			$table->timestamp('tanggal_berakhir')->default(Carbon::now());
			$table->boolean('soft_deleted')->default(false);
			$table->timestamps();

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
		Schema::dropIfExists('promos');
	}
}
