<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartrwhAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_tr_wh', function (Blueprint $table){
            $table->string('wh_date')->nullable();
            $table->tinyInteger('wh_time_is_interval')->nullable();
            $table->string('wh_time')->nullable();
            $table->string('wh_time_from')->nullable();
            $table->string('wh_time_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_tr_wh', function (Blueprint $table){
            $table->dropColumn('wh_date');
            $table->dropColumn('wh_time_is_interval');
            $table->dropColumn('wh_time');
            $table->dropColumn('wh_time_from');
            $table->dropColumn('wh_time_to');
        });
    }
}
