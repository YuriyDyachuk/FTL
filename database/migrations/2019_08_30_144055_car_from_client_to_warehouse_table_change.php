<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarFromClientToWarehouseTableChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_rqst_cl_wh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responsible_id')->unsigned()->nullable()->comment('Ответственный');
            $table->bigInteger('client_id')->unsigned()->nullable()->comment('Клиент');
            $table->string('order_index')->nullable()->comment('Индекс заявки');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('car_type')->nullable()->comment('Вид авто');
            $table->string('temp_mode')->nullable()->comment('Температурный режим');
            $table->string('downloading_method')->nullable()->comment('Способ погрузки');

            // ПОГРУЗКА
            $table->string('downloading_wh_address')->nullable('Адрес склада');
            $table->integer('downloading_power_of_attorney_number')->nullable()->comment('Номер доверенности на погрузке');
            $table->string('downloading_power_of_attorney_scan')->nullable()->comment('Скан доверенности на погрузке');
            $table->date('downloading_date')->nullable()->comment('Дата Погрузки');
            $table->string('downloading_date_photo')->nullable();
            $table->boolean('downloading_time_is_interval')->nullable();
            $table->string('downloading_time')->nullable();
            $table->string('downloading_time_from')->nullable();
            $table->string('downloading_time_to')->nullable();
            $table->string('downloading_contact_name')->nullable();
            $table->string('downloading_contact_phone')->nullable();

            // ВЫГРУЗКА
            $table->string('unloading_city')->nullable()->comment('Город выгрузки');
            $table->string('unloading_name')->nullable()->comment('Название выгрузки');
            $table->integer('unloading_code')->nullable()->comment('Код выгрузки');
            $table->integer('unloading_address')->nullable()->comment('Адрес выгрузки');
            $table->integer('unloading_power_of_attorney_number')->nullable()->comment('Номер доверенности на выгрузке');
            $table->string('unloading_power_of_attorney_scan')->nullable()->comment('Скан доверенности на выгрузке');
            $table->date('unloading_date')->nullable()->comment('Дата Погрузки');
            $table->string('unloading_date_photo')->nullable();
            $table->boolean('unloading_time_is_interval')->nullable();
            $table->string('unloading_time')->nullable();
            $table->string('unloading_time_from')->nullable();
            $table->string('uloading_time_to')->nullable();
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
            $table->string('cargo_fastening')->nullable()->comment('Крепление груза');
            $table->string('cargo_transporting')->nullable()->comment('Транспортировка груза');
            $table->string('special_cond_file')->nullable()->comment('Особые условия выбор Файла');


            $table->boolean('forwarding_enabled')->nullable()->comment('Экспедирование');
            $table->bigInteger('forwarding_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('lead_id')->references('id')->on('leads')
                ->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_rqst_cl_wh');
    }
}
