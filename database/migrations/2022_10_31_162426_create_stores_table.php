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
        Schema::create('stores', function (Blueprint $table) {
            $table->string('username');
            $table->string('name');
            $table->string('store_name');
            $table->string('password');
            $table->string('bank_account');
            $table->string('phone_number');
            $table->boolean('gender');
            $table->foreign('gender')->references('id')->on('genders');
            $table->primary('username');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
