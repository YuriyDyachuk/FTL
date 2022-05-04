<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarWhTrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_wh_tr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();
            // ПОГРУЗКА
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
            $table->string('downloading_wh_city')->nullable();
            $table->string('downloading_wh_name')->nullable();
            $table->string('downloading_wh_code')->nullable();
            $table->string('downloading_wh_address')->nullable();
            // ВЫГРУЗКА:
            $table->date('unloading_date')->nullable();
            $table->string('unloading_date_photo')->nullable();
            $table->boolean('unloading_time_is_interval')->nullable();
            $table->string('unloading_time')->nullable();
            $table->string('unloading_time_from')->nullable();
            $table->string('unloading_time_to')->nullable();
            $table->string('unloading_wh_city')->nullable();
            $table->string('unloading_wh_name')->nullable();
            $table->string('unloading_wh_code')->nullable();
            $table->string('unloading_wh_address')->nullable();
            $table->integer('unloading_power_of_attorney_number')->nullable();
            $table->string('unloading_power_of_attorney_scan')->nullable();
            $table->string('unloading_contact_name')->nullable();
            $table->string('unloading_contact_phone')->nullable();
            // ПЕРЕВОЗЧИК
            $table->bigInteger('carrier_id')->unsigned()->nullable();
            $table->string('carrier_name')->nullable();
            $table->string('carrier_inn')->nullable();
            // ВОДИТЕЛЬ
            $table->string('driver_fio')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('driver_passport')->nullable();
            $table->string('driver_vu')->nullable();
            $table->string('driver_car')->nullable();
            $table->string('driver_trailer_num')->nullable();
            // ОСОБЫЕ УСЛОВИЯ
            $table->string('cargo_fastening_desc')->nullable()->comment('Описание');
            $table->string('cargo_transporting')->nullable()->comment('Транспортировка груза');
            $table->string('special_cond_file')->nullable()->comment('Особые условия выбор Файла');

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
        Schema::dropIfExists('car_wh_tr');
    }
}
