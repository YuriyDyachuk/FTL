<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGettingActDriverReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getting_act_driver_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('getting_act_id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_data')->nullable();
            $table->string('number_and_date_of_vu_delivery')->nullable();
            $table->string('mark_and_number_of_car')->nullable();
            $table->string('trailer_num')->nullable();
            $table->foreign('getting_act_id')->references('id')->on('getting_act')
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
        Schema::dropIfExists('getting_act_driver_report');
    }
}
