<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRespUserIdColumns extends Migration
{
    private $tables = ['car_ldcr_rent', 'car_rqst_cl_wh', 'car_rqst_tm_wh', 'car_tr_wh', 'car_wh_cl', 'car_wh_tm', 'car_wh_tr', 'tr', 'tr_cross', 'wh_cross', 'wh_gt', 'wh_ktk_down'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function(Blueprint $q){
                $q->integer('responsible_user_id')->unsigned()->nullable();
                $q->integer('responsible_chief_id')->unsigned()->nullable();
                $q->foreign('responsible_user_id')->on('users')->references('id')->onDelete('set null')->onUpdate('restrict');
                $q->foreign('responsible_chief_id')->on('users')->references('id')->onDelete('set null')->onUpdate('restrict');
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
        //
    }
}
