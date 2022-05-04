<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WarerstcrossdockingAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_cross_docking', function(Blueprint $table){
            $table->boolean('forwarding_enabled')->nullable();
            $table->string('order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_request_cross_docking', function(Blueprint $table){
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('order_id');
        });
    }
}
