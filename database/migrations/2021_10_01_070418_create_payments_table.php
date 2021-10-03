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
            $table->integer('order_id')->unique();
            $table->string('bill');
            $table->string('link')->unique();
            $table->string('transaction_id')->unique();
            $table->string('reference_id')->unique()->nullable();
            $table->integer('status_code')->nullable();
            $table->integer('stdID')->unique();
            $table->string('name');
            $table->string('family');
            $table->string('mobile');
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
        Schema::dropIfExists('payments');
    }
}
