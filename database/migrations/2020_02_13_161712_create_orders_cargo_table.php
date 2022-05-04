<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_gt_cargo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wh_gt_id')->unsigned();
            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('wh_gt_id')->on('wh_gt')->references('id')->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('cargo_id')->on('client_request_products')->references('id')->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });
        Schema::create('car_rqst_cl_wh_cargo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('car_rqst_cl_wh_id')->unsigned();
            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('car_rqst_cl_wh_id')->on('car_rqst_cl_wh')->references('id')->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('cargo_id')->on('client_request_products')->references('id')->onDelete('cascade')->onUpdate('restrict');
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
        Schema::dropIfExists('wh_gt_cargo');
        Schema::dropIfExists('car_rqst_cl_wh_cargo');
    }
}
