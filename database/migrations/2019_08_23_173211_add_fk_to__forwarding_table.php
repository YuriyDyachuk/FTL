<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_request_from_train_station_to_client', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('car_request_from_warehouse_to_train_station', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('train_request', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('warehouse_request_container_downloading', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('warehouse_request_cross_docking', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('warehouse_request_forwarding_on_getting', function (Blueprint $table) {
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
        });
        Schema::table('warehouse_request_getting', function (Blueprint $table) {
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
        Schema::table('car_request_from_train_station_to_client', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('car_request_from_warehouse_to_train_station', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('train_request', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('warehouse_request_container_downloading', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('warehouse_request_cross_docking', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
        Schema::table('warehouse_request_getting', function (Blueprint $table) {
            $table->dropColumn('forwarding_id');
        });
    }
}
