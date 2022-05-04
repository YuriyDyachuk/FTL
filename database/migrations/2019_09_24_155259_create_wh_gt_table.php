<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhGtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_gt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();
            $table->string('car_type')->nullable();
            $table->string('temp_mode')->nullable();
            $table->string('downloading_method')->nullable();
            $table->string('downloading_scheme')->nullable()->comment('Схема погрузки в jpg или pdf');
            $table->boolean('forwarding_enabled')->nullable();
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
            // Приём:
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
            // ПЕРЕВОЗЧИК
            $table->bigInteger('carrier_id')->unsigned()->nullable()->comment('Перевозчик');
            $table->string('carrier_name')->nullable()->comment('Перевозчик название');
            $table->string('carrier_inn')->nullable()->comment('Перевозчик ИНН');
            // ВОДИТЕЛЬ
            $table->string('driver_fio')->nullable()->comment('Водитель ФИО');
            $table->string('driver_phone')->nullable()->comment('Водитель Телефон');
            $table->string('driver_passport')->nullable()->comment('Водитель Паспортные данные');
            $table->string('driver_vu')->nullable()->comment('Водитель Номер и дата выдачи ВУ');
            $table->string('driver_car')->nullable()->comment('Водитель Марка и номер машины');
            $table->string('driver_trailer_num')->nullable()->comment('Водитель Номер прицепа');
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
        Schema::dropIfExists('wh_gt');
    }
}
