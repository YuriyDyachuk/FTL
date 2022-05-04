<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewCarOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_tm_pr_tr', function (Blueprint $table) {
            $table->bigIncrements('id');
            //терминал
            $table->string('tm_city');
            $table->string('tm_name');
            $table->string('tm_address');
            $table->string('date_from');
            $table->string('time_from_from');
            $table->string('time_from_to');
            $table->string('time_from');
            $table->tinyInteger('time_from_is_interval');
            $table->string('tm_power_of_attorney_scan');
            $table->string('tm_driving_scheme');
            $table->string('tm_contact_name');
            $table->string('tm_contact_phone');
            //поставщик
            $table->string('pr_date');
            $table->string('pr_time');
            $table->string('pr_time_from');
            $table->string('pr_time_to');
            $table->tinyInteger('pr_time_is_interval');
            $table->string('pr_wh_city');
            $table->string('pr_wh_name');
            $table->string('pr_power_of_attorney_scan');
            $table->string('pr_driving_scheme');
            $table->string('pr_contact_name');
            $table->string('pr_contact_phone');
            //жд
            $table->string('date_to');
            $table->string('time_to');
            $table->string('time_to_from');
            $table->string('time_to_to');
            $table->tinyInteger('time_to_is_interval');
            $table->string('tr_city');
            $table->string('tr_name');
            $table->string('tr_code');
            $table->string('tr_address');
            $table->string('tr_contact_name');
            $table->string('tr_contact_phone');
            $table->timestamps();
        });
    }
// cartmprovtr
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_tm_pr_tr');
    }
}
