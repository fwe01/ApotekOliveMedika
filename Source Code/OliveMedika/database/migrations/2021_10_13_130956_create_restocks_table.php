<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestocksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
			'restocks',
			function (Blueprint $table) {
				$table->id();
				$table->unsignedBigInteger('id_barang');
				$table->string('username_admin');
				$table->unsignedInteger('jumlah');
				$table->float('harga_per_unit');
				$table->timestamps();

				$table->foreign('id_barang')->references('id')->on('barangs');
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('restocks');
	}
}
