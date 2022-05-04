<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_leads', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('goods_id');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('goods_id')->references('id')->on('goods')->onDelete('cascade')->onUpdate('restrict');
            $table->unique(['lead_id', 'goods_id']);
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
        Schema::dropIfExists('goods_leads');
    }
}
