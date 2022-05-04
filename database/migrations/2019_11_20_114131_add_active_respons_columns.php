<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveResponsColumns extends Migration
{
    private $order_tables = ['client_requests', 'car_ldcr_rent', 'car_rqst_cl_wh', 'car_rqst_tm_wh', 'car_tr_wh', 'car_wh_cl', 'car_wh_tm', 'car_wh_tr', 'tr', 'tr_cross', 'wh_cross', 'wh_gt', 'wh_ktk_down'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->order_tables as $order_table) {
            Schema::table($order_table, function(Blueprint $table){
                $table->unsignedInteger('active_responsible_user_id')->nullable();
                $table->foreign('active_responsible_user_id')->on('users')->references('id')->onDelete('set null')->onUpdate('restrict');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->order_tables as $order_table) {
            Schema::table($order_table, function(Blueprint $table){
                $table->dropColumn('active_responsible_user_id');
            });
        }
    }
}
