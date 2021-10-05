<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anjoman_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('stdID')->unique();
            $table->string('name');
            $table->string('family');
            $table->string('mobile');
            $table->integer('hamrahan')->default(0); // tedad hamrahan
            $table->boolean('tandis')->default(false); // tandis
            $table->integer('launchs')->default(0);
            $table->integer('dinners')->default(0);
            $table->timestamps();

            $table->foreign('anjoman_id')->references('id')->on('anjomans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
