<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExternalOrdersTables extends Migration
{
    private $carTables = ['car_ldcr_rent', 'car_rqst_cl_wh', 'car_rqst_tm_wh', 'car_tr_wh', 'car_wh_cl', 'car_wh_tm', 'car_wh_tr'];
    private $trTables = ['tr', 'tr_cross'];
    private $whTables = ['wh_cross', 'wh_gt', 'wh_ktk_down'];
    private $ordersTables = ['car_orders', 'tr_orders', 'wh_orders'];

    public function up()
    {
        foreach ($this->carTables as $table) {
            Schema::table($table, function (Blueprint $t){
                $t->integer('car_order')->unsigned()->nullable();
            });
        }
        foreach ($this->trTables as $table) {
            Schema::table($table, function (Blueprint $t){
                $t->integer('tr_order')->unsigned()->nullable();
            });
        }
        foreach ($this->whTables as $table) {
            Schema::table($table, function (Blueprint $t){
                $t->integer('wh_order')->unsigned()->nullable();
            });
        }
        foreach ($this->ordersTables as $ordersTable) {
            Schema::table($ordersTable, function(Blueprint $t){
                $t->string('table')->nullable();
                $t->integer('origin_id')->nullable();
                $t->integer('lead_id')->nullable();
                $t->integer('order_status')->nullable();
                $t->integer('client_request_status')->nullable();
                $t->string('client_name')->nullable();
                $t->integer('responsible_branch_chief_id')->nullable();
                $t->integer('responsible_user_id')->nullable();
                $t->integer('active_responsible_user_id')->nullable();
            });
        }
    }


    public function down()
    {
        //
    }
}
