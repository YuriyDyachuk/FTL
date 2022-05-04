<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarTmPrTrAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_tm_pr_tr', function (Blueprint $table){

            $table->bigInteger('responsible_id')->unsigned()->nullable()->comment('Ответственный');
            $table->bigInteger('active_responsible_user_id')->unsigned()->nullable()->comment('Активно Ответственный');
            $table->bigInteger('client_id')->unsigned()->nullable()->comment('Клиент');
            $table->string('order_index')->nullable()->comment('Индекс заявки');
            $table->bigInteger('lead_id')->unsigned();

            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
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
