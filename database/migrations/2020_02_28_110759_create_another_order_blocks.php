<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotherOrderBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_data')->nullable();
            $table->string('number_and_date_of_vu_delivery')->nullable()->comment('Номер и дата выдачи ВУ');
            $table->string('mark_and_number_of_car')->nullable()->comment('Марка и номер машины');
            $table->string('trailer_num')->nullable()->comment('Номер прицепа');
            $table->timestamps();
        });

        Schema::create('driver_blocks_orders', function (Blueprint $table){
            $table->unsignedBigInteger('driver_block_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('driver_block_id')->references('id')->on('driver_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('spec_conds_block', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->string('file')->nullable();
            $table->string('transport')->nullable();
            $table->timestamps();
        });

        Schema::create('spec_conds_blocks_orders', function (Blueprint $table){
            $table->unsignedBigInteger('spec_conds_block_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('spec_conds_block_id')->references('id')->on('spec_conds_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('heavy_rent_block', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('direction_type');
            $table->string('address')->nullable();
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('place_weight')->nullable();
            $table->string('place_size')->nullable();
            $table->string('cargo_photo')->nullable();
            $table->string('other_files')->nullable();
            $table->timestamps();
        });

        Schema::create('heavy_rent_blocks_orders', function (Blueprint $table){
            $table->unsignedBigInteger('heavy_rent_block_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('heavy_rent_block_id')->references('id')->on('heavy_rent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
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
        Schema::dropIfExists('driver_blocks_orders');
        Schema::dropIfExists('driver_block');

        Schema::dropIfExists('spec_conds_blocks_orders');
        Schema::dropIfExists('spec_conds_block');

        Schema::dropIfExists('heavy_rent_blocks_orders');
        Schema::dropIfExists('heavy_rent_block');
    }
}
