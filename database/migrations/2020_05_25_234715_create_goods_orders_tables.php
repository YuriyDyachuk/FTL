<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('goods_id');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('goods_id')->references('id')->on('goods')->onDelete('cascade')->onUpdate('restrict');
            $table->unique(['order_id', 'goods_id']);
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
        Schema::dropIfExists('goods_orders');
    }
}
