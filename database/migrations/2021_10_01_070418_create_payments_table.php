<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anjoman_id');
            $table->boolean('is_paid')->default(false);
            $table->boolean('person_confirmed')->default(false);
            $table->integer('order_id')->unique();
            $table->string('transaction_id')->unique()->nullable();
            $table->string('reference_id')->unique()->nullable();
            $table->integer('status_code')->nullable();
            $table->string('link')->unique()->nullable();
            $table->string('bill');
            $table->integer('stdID')->unique();
            $table->string('name');
            $table->string('family');
            $table->string('mobile');
            $table->integer('hamrahan')->default(0); // tedad hamrahan
            $table->boolean('tandis')->default(false); // tandis
            $table->integer('launchs')->default(0); // nahar
            $table->integer('dinners')->default(0); // shaam
            $table->timestamps();

            $table->foreign('anjoman_id')->references('id')->on('anjomans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
