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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
            $table->string('color');
            $table->string('screen_technology');
            $table->string('screen_size');
            $table->string('os');
            $table->string('cpu');
            $table->string('resolution');
            $table->string('camera');
            $table->string('weight');
            $table->integer('rom');
            $table->integer('ram');
            $table->string('sim');
            $table->string('pin');

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
        Schema::dropIfExists('product_details');
    }
};
