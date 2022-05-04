<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarLdcrRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_ldcr_rent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();
            $table->string('equip_type')->nullable();
            //Подача:
            $table->date('delivery_date')->nullable();
            $table->string('delivery_date_photo')->nullable();
            $table->boolean('delivery_time_is_interval')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('delivery_time_from')->nullable();
            $table->string('delivery_time_to')->nullable();
            $table->string('delivery_contact_name')->nullable();
            $table->string('delivery_contact_phone')->nullable();

            $table->string('delivery_address')->nullable();
            $table->string('cargo_place_amount')->nullable();
            $table->string('cargo_place_size')->nullable();
            $table->string('cargo_photo')->nullable();

            //Дата Окончания операции
            $table->date('finish_date')->nullable();
            $table->string('finish_date_photo')->nullable();
            $table->boolean('finish_time_is_interval')->nullable();
            $table->string('finish_time')->nullable();
            $table->string('finish_time_from')->nullable();
            $table->string('finish_time_to')->nullable();


            $table->string('more_files')->nullable();
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
            $table->boolean('forwarding_enabled')->nullable();
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
        Schema::dropIfExists('car_ldcr_rent');
    }
}
