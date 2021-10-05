<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnjomansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anjomans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('person_price');
            $table->string('hamrahan_price');
            $table->integer('total_people');
            $table->integer('used_people')->default(0);
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
        Schema::dropIfExists('anjomans');
    }
}