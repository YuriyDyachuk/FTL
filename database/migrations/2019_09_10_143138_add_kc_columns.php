<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKcColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_rqst_cl_wh', function(Blueprint $table){
            $table->string('downloading_wh_city')->nullable()->comment('Город')->after('downloading_wh_address');
            $table->string('downloading_wh_name')->nullable()->comment('Наименование')->after('downloading_wh_city');
            $table->string('downloading_wh_code')->nullable()->comment('Код')->after('downloading_wh_name');
            $table->string('cargo_transporting_description')->nullable()->comment('Крепление груза описание')->after('cargo_transporting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_rqst_cl_wh', function(Blueprint $table){
            $table->dropColumn('downloading_wh_city');
            $table->dropColumn('downloading_wh_name');
            $table->dropColumn('downloading_wh_code');
            $table->dropColumn('cargo_transporting_description');
        });
    }
}
