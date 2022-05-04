<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_data')->nullable();
            $table->string('number_and_date_of_vu_delivery')->nullable();
            $table->string('mark_and_number_of_car')->nullable();
            $table->string('trailer_num')->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_report');
    }
}
