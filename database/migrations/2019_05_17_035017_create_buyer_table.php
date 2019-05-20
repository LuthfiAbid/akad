<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer', function (Blueprint $table) {
            $table->increments('id_buyer');
            $table->string('username',50);
            $table->string('password');
            $table->string('buyer_name',100);
            $table->string('address');
            $table->string('city');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
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
        Schema::dropIfExists('buyer');
    }
}
