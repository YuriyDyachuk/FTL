<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadDriverReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_driver_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_data')->nullable();
            $table->string('number_and_date_of_vu_delivery')->nullable();
            $table->string('mark_and_number_of_car')->nullable();
            $table->string('trailer_num')->nullable();
            $table->timestamps();
            $table->foreign('lead_id')->references('id')->on('leads')
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
        Schema::dropIfExists('lead_driver_report');
    }
}
