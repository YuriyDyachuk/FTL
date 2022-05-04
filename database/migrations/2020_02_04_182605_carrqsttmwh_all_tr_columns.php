<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarrqsttmwhAllTrColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_rqst_tm_wh',  function (Blueprint $table){
            $table->string('tr_code')->nullable();

            $table->string('ftl_date')->nullable();
            $table->tinyInteger('ftl_time_is_interval')->nullable();
            $table->string('ftl_time')->nullable();
            $table->string('ftl_time_from')->nullable();
            $table->string('ftl_time_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_rqst_tm_wh',  function (Blueprint $table){
            $table->dropColumn('tr_code');

            $table->dropColumn('ftl_date');
            $table->dropColumn('ftl_time_is_interval');
            $table->dropColumn('ftl_time');
            $table->dropColumn('ftl_time_from');
            $table->dropColumn('ftl_time_to');
        });
    }
}
