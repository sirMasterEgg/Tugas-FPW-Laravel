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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('username');
            $table->string('name');
            $table->string('password');
            $table->string('address');
            $table->string('phone_number');
            $table->boolean('gender');
            $table->integer('saldo')->default(0);
            $table->primary('username');
            $table->foreign('gender')->references('id')->on('genders');
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
        Schema::dropIfExists('customers');
    }
};
