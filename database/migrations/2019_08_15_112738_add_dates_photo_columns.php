<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesPhotoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_request_from_train_station_to_client', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('train_request', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('warehouse_request_container_downloading', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('warehouse_request_cross_docking', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
        Schema::table('warehouse_request_getting', function(Blueprint $t){
            $t->string('unloading_date_photo')->nullable();
            $t->string('downloading_date_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_request_from_train_station_to_client', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('train_request', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('warehouse_request_container_downloading', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('warehouse_request_cross_docking', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
        Schema::table('warehouse_request_getting', function(Blueprint $t){
            $t->dropColumn('unloading_date_photo');
            $t->dropColumn('downloading_date_photo');
        });
    }
}
