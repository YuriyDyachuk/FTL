<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WarerstgettingAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_getting', function(Blueprint $table){
            $table->string('order_index')->nullable();
            $table->boolean('forwarding_enabled')->nullable();
            $table->string('am_num')->nullable()->comment('Номер а/м');
            $table->string('railway_carriage_num')->nullable()->comment('Номер вагона');
            $table->date('cargo_getting_date')->nullable()->comment('Дата прихода груза');
            $table->string('cargo_getting_time')->nullable()->comment('Время прихода груза');
            $table->string('cargo_photo')->nullable()->comment('Фотография груза');
            $table->string('kg_place_average_weight')->nullable()->comment('Средняя масса места в килограммах');
            $table->string('kg_all_weight')->nullable()->comment('Масса всего груза в килограммах');
            $table->string('place_av_size')->nullable()->comment('Средний размер места длина*ширина*высота в мм');
            $table->string('car_type')->nullable()->comment('Тип транспорта (универсальный/реф/термос)');
            $table->string('unloading_method')->nullable()->comment('Способ выгрузки (Верх/бок/фронт/самоход)');
            $table->boolean('tmc_unloading_on_pallets')->comment('Выгрузка ТМЦ на паллетах');
            $table->boolean('tmc_unloading_naval')->comment('Выгрузка ТМЦ навал');
            $table->boolean('tmc_unloading_oversize')->comment('Выгрузка ТМЦ негабарит');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_request_getting', function(Blueprint $table){
            $table->dropColumn('order_index');
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('am_num');
            $table->dropColumn('railway_carriage_num');
            $table->dropColumn('cargo_getting_date');
            $table->dropColumn('cargo_getting_time');
            $table->dropColumn('cargo_photo');
            $table->dropColumn('kg_place_average_weight');
            $table->dropColumn('kg_all_weight');
            $table->dropColumn('place_av_size');
            $table->dropColumn('car_type');
            $table->dropColumn('unloading_method');
            $table->dropColumn('tmc_unloading_on_pallets');
            $table->dropColumn('tmc_unloading_naval');
            $table->dropColumn('tmc_unloading_oversize');
        });
    }
}
