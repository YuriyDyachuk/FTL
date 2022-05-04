<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhCrossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_cross', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();
            // ПРИЕМ
            $table->date('getting_date')->nullable();
            $table->string('getting_date_photo')->nullable();
            $table->boolean('getting_time_is_interval')->nullable();
            $table->string('getting_time')->nullable();
            $table->string('getting_time_from')->nullable();
            $table->string('getting_time_to')->nullable();
            $table->integer('getting_power_of_attorney_number')->nullable();
            $table->string('getting_power_of_attorney_scan');
            $table->string('getting_contact_name')->nullable();
            $table->string('getting_contact_phone')->nullable();
            // ПРИЕМ ПЕРЕВОЗЧИК
            $table->bigInteger('getting_carrier_id')->unsigned()->nullable();
            $table->string('getting_carrier_name')->nullable();
            $table->string('getting_carrier_inn')->nullable();
            // ПРИЕМ ВОДИТЕЛЬ
            $table->string('getting_driver_fio')->nullable();
            $table->string('getting_driver_phone')->nullable();
            $table->string('getting_driver_passport')->nullable();
            $table->string('getting_driver_vu')->nullable();
            $table->string('getting_driver_car')->nullable();
            $table->string('getting_driver_trailer_num')->nullable();

            $table->string('getting_car_type')->nullable();
            $table->string('getting_temp_mode')->nullable();
            $table->string('getting_downloading_method')->nullable();
            // ЗАГРУЗКА
            $table->date('downloading_date')->nullable();
            $table->string('downloading_date_photo')->nullable();
            $table->boolean('downloading_time_is_interval')->nullable();
            $table->string('downloading_time')->nullable();
            $table->string('downloading_time_from')->nullable();
            $table->string('downloading_time_to')->nullable();
            $table->integer('downloading_power_of_attorney_number')->nullable();
            $table->string('downloading_power_of_attorney_scan')->nullable();
            $table->string('downloading_contact_name')->nullable();
            $table->string('downloading_contact_phone')->nullable();
            // ЗАГРУЗКА ПЕРЕВОЗЧИК
            $table->bigInteger('downloading_carrier_id')->unsigned()->nullable();
            $table->string('downloading_carrier_name')->nullable();
            $table->string('downloading_carrier_inn')->nullable();
            // ЗАГРУЗКА ВОДИТЕЛЬ
            $table->string('downloading_driver_fio')->nullable();
            $table->string('downloading_driver_phone')->nullable();
            $table->string('downloading_driver_passport')->nullable();
            $table->string('downloading_driver_vu')->nullable();
            $table->string('downloading_driver_car')->nullable();
            $table->string('downloading_driver_trailer_num')->nullable();
            $table->string('downloading_scheme')->nullable();

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
        Schema::dropIfExists('wh_cross');
    }
}
