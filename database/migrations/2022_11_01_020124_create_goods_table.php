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
        Schema::create('goods', function (Blueprint $table) {
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->integer('stok_barang');
            $table->string('username_store');
            $table->foreign('username_store')->references('username')->on('stores');
            $table->primary('kode_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
};
