<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_trans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_head_trans');
            $table->string('kode_barang');
            $table->integer('jumlah_barang');
            $table->foreign('id_head_trans')->references('id')->on('head_trans');
            $table->foreign('kode_barang')->references('kode_barang')->on('goods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_trans');
    }
};
