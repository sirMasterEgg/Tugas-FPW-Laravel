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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->string('username_customer');
            $table->foreign('username_customer')->references('username')->on('customers');

            $table->string('username_store');
            $table->foreign('username_store')->references('username')->on('stores');

            $table->string('kode_barang');
            $table->foreign('kode_barang')->references('kode_barang')->on('goods');

            $table->integer('jumlah_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
