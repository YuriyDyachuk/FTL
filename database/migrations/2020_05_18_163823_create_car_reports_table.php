<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->tinyInteger('is_departure')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('day_photo')->nullable();
            $table->string('rest_of_km')->nullable();
            $table->string('rest_of_days')->nullable();
            $table->string('waybill')->nullable()->comment('Накладная');
            $table->string('other')->nullable();
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
        Schema::dropIfExists('car_report');
    }
}
