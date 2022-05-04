<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrCrossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_cross', function (Blueprint $table) {
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
            $table->string('railway_carriage_info')->nullable();
            //Загрузка Авто
            $table->date('car_downl_date')->nullable();
            $table->string('car_downl_date_photo')->nullable();
            $table->boolean('car_downl_time_is_interval')->nullable();
            $table->string('car_downl_time')->nullable();
            $table->string('car_downl_time_from')->nullable();
            $table->string('car_downl_time_to')->nullable();
            $table->string('car_downl_car_type')->nullable()->comment('Вид авто');
            $table->string('car_downl_temp_mode')->nullable()->comment('Температурный режим');
            $table->string('car_downl_downloading_method')->nullable()->comment('Способ погрузки');
            $table->integer('car_downl_power_of_attorney_number')->nullable();
            $table->string('car_downl_power_of_attorney_scan');
            $table->string('car_downl_contact_name')->nullable();
            $table->string('car_downl_contact_phone')->nullable();
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
        Schema::dropIfExists('tr_cross');
    }
}
