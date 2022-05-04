<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();

            // Отправление:
            $table->date('from_date')->nullable();
            $table->string('from_date_photo')->nullable();
            $table->string('from_time')->nullable();
            $table->string('from_contact_name')->nullable();
            $table->string('from_contact_phone')->nullable();
            $table->string('from_wh_city')->nullable();
            $table->string('from_wh_name')->nullable();
            $table->string('from_wh_code')->nullable();
            $table->string('from_wh_address')->nullable();
            // Прибытие:
            $table->date('to_date')->nullable();
            $table->string('to_date_photo')->nullable();
            $table->string('to_time')->nullable();
            $table->string('to_contact_name')->nullable();
            $table->string('to_contact_phone')->nullable();
            $table->string('to_wh_city')->nullable();
            $table->string('to_wh_name')->nullable();
            $table->string('to_wh_code')->nullable();
            $table->string('to_wh_address')->nullable();

            $table->string('spec_conds')->nullable();

            $table->boolean('forwarding_enabled')->nullable();
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tr');
    }
}
