<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTrWhTm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_tr_ftl_tm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->integer('car_order')->unsigned()->nullable();
            $table->string('date_from_photo')->nullable();
            $table->string('ftl_date_photo')->nullable();
            $table->string('date_to_photo')->nullable();

            $table->integer('responsible_chief_id')->unsigned()->nullable();
            $table->integer('responsible_branch_chief_id')->unsigned()->nullable();
            $table->bigInteger('responsible_id')->unsigned()->nullable()->comment('Ответственный');
            $table->bigInteger('active_responsible_user_id')->unsigned()->nullable()->comment('Активно Ответственный');
            $table->bigInteger('client_id')->unsigned()->nullable()->comment('Клиент');
            $table->string('order_index')->nullable()->comment('Индекс заявки');
            $table->bigInteger('lead_id')->unsigned();

            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');

            // tr
            $table->string('tr_city');
            $table->string('tr_name');
            $table->string('tr_address');
            $table->string('tr_code');
            $table->string('date_from');

            $table->string('time_from_is_interval');
            $table->string('time_from');
            $table->string('time_from_from');
            $table->string('time_from_to');

            $table->string('tr_contact_name');
            $table->string('tr_contact_phone');

            // ftl
            $table->string('ftl_city');
            $table->string('ftl_name');
            $table->string('ftl_address');
            $table->string('ftl_date');

            $table->string('ftl_time_is_interval');
            $table->string('ftl_time');
            $table->string('ftl_time_from');

            $table->string('ftl_time_to');

            $table->string('ftl_contact_name');
            $table->string('ftl_contact_phone');

            $table->string('ftl_power_of_attorney_scan');
            $table->string('ftl_driving_scheme');

            // tm
            $table->string('tm_city');
            $table->string('tm_name');
            $table->string('tm_address');
            $table->string('date_to');

            $table->string('time_to_is_interval');
            $table->string('time_to');
            $table->string('time_to_from');

            $table->string('time_to_to');

            $table->string('tm_contact_name');
            $table->string('tm_contact_phone');

            $table->string('tm_power_of_attorney_scan');
            $table->string('tm_driving_scheme');


            $table->timestamps();
        });

        Schema::table('order_notes', function (Blueprint $table){
            $table->bigInteger('car_tr_ftl_tm_id')->unsigned()->nullable();
            $table->foreign('car_tr_ftl_tm_id')->on('car_tr_ftl_tm')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_tr_ftl_tm');
        Schema::table('order_notes', function (Blueprint $table){
            $table->dropColumn('car_tr_ftl_tm_id');
        });
    }
}
