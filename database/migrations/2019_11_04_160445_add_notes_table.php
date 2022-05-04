<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesTable extends Migration
{
    private $order_columns = ['client_requests', 'car_ldcr_rent', 'car_rqst_cl_wh', 'car_rqst_tm_wh', 'car_tr_wh', 'car_wh_cl', 'car_wh_tm', 'car_wh_tr', 'tr', 'tr_cross', 'wh_cross', 'wh_gt', 'wh_ktk_down'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_notes', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->smallInteger('note_type')->nullable()->comment('system, user');
            foreach ($this->order_columns as $order_id_column) {
                $table->bigInteger($order_id_column.'_id')->unsigned()->nullable();
                $table->foreign($order_id_column.'_id')->on($order_id_column)->references('id')->onDelete('cascade')->onUpdate('restrict');
            }
            $table->json('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_notes');
    }
}
