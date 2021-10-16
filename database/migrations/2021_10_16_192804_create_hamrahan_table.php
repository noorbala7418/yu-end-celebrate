<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHamrahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hamrahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anjoman_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('stdID');
            $table->string('name');
            $table->string('family');
            $table->string('mobile');
            $table->integer('hamrahan')->default(0); // tedad hamrahan
            $table->integer('launchs')->default(0);
            $table->integer('dinners')->default(0);
            $table->string('bill');
            $table->timestamps();

            $table->foreign('anjoman_id')->references('id')->on('anjomans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('hamrahan_payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hamrahan');
    }
}
