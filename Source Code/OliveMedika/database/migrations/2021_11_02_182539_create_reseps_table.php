<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_user');
			$table->string('gambar');
			$table->string('status');
			$table->string('keterangan')->nullable();
			$table->boolean('soft_deleted')->default(false);
			$table->timestamps();

			$table->foreign('id_user')->references('id')->on('users');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseps');
    }
}
