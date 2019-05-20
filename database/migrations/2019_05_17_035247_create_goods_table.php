<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id_goods');
            $table->string('goods_name',50);
            $table->string('stock');
            $table->string('price');
            $table->string('picture');
            $table->string('description')->nullable();
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('goods');
    }
}
