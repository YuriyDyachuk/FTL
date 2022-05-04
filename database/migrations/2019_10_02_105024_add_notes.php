<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotes extends Migration
{
    public $forms = ['car_ldcr_rent', 'car_rqst_cl_wh', 'car_rqst_tm_wh', 'car_tr_cl', 'car_wh_cl', 'car_wh_tm', 'car_wh_tr', 'tr', 'tr_cross', 'wh_cross', 'wh_gt', 'wh_ktk_down'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach ($this->forms as $form) {
            Schema::table($form, function(Blueprint $table){
                $table->string('notes')->nullable();
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
        foreach ($this->forms as $form) {
            Schema::table($form, function(Blueprint $table){
                $table->dropColumn('notes');
            });
        }
    }
}
