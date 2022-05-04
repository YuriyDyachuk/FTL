<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTrClTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_tr_cl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->string('order_index')->nullable();
            $table->bigInteger('lead_id')->unsigned();
            $table->string('status')->nullable();
            $table->string('car_type')->nullable();
            $table->string('temp_mode')->nullable();
            $table->string('downloading_method')->nullable();
            // ПОГРУЗКА:
            $table->date('downloading_date')->nullable();
            $table->string('downloading_date_photo')->nullable();
            $table->boolean('downloading_time_is_interval')->nullable();
            $table->string('downloading_time')->nullable();
            $table->string('downloading_time_from')->nullable();
            $table->string('downloading_time_to')->nullable();
            $table->string('downloading_tr_city')->nullable();
            $table->string('downloading_tr_name')->nullable();
            $table->string('downloading_tr_code')->nullable();
            $table->string('downloading_tr_address')->nullable();
            $table->string('downloading_contact_name')->nullable();
            $table->string('downloading_contact_phone')->nullable();
            // ВЫГРУЗКА:
            $table->date('unloading_date')->nullable()->comment('Дата Погрузки');
            $table->string('unloading_date_photo')->nullable();
            $table->boolean('unloading_time_is_interval')->nullable();
            $table->string('unloading_time')->nullable();
            $table->string('unloading_time_from')->nullable();
            $table->string('unloading_time_to')->nullable();
            $table->string('unloading_wh_name')->nullable();
            $table->string('unloading_wh_code')->nullable();
            $table->string('unloading_wh_city')->nullable();
            $table->string('unloading_wh_address')->nullable();
            $table->integer('unloading_power_of_attorney_number')->nullable();
            $table->string('unloading_power_of_attorney_scan')->nullable();
            $table->string('unloading_contact_name')->nullable();
            $table->string('unloading_contact_phone')->nullable();
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
        Schema::dropIfExists('car_tr_cl');
    }
}
