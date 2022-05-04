<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarTmPrTrAddDateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_tm_pr_tr', function (Blueprint $table){
            $table->string('date_from_photo')->nullable();
            $table->string('pr_date_photo')->nullable();
            $table->string('date_to_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_tm_pr_tr', function (Blueprint $table){
            $table->dropColumn('date_from_photo');
            $table->dropColumn('pr_date_photo');
            $table->dropColumn('date_to_photo');
        });
    }
}
