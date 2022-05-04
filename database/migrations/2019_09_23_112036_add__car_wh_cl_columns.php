<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarWhClColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_wh_cl', function(Blueprint $table){
            $table->boolean('forwarding_enabled')->nullable();
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_wh_cl', function(Blueprint $table){
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('forwarding_id');
        });
    }
}
