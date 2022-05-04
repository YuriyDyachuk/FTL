<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WarerstforwcontdownAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->string('order_index')->nullable();
            $table->boolean('forwarding_enabled')->nullable();
            $table->string('am_num')->nullable()->comment('Номер а/м');
            $table->string('railway_carriage_num')->nullable()->comment('Номер вагона');
            $table->string('trailer_num')->nullable()->comment('Номер прицепа');
            $table->string('driver')->nullable()->comment('Водитель');
            $table->string('cargo_photo')->nullable()->comment('Фотография груза');
            $table->string('kg_place_average_weight')->nullable()->comment('Средняя масса места в килограммах');
            $table->string('kg_all_weight')->nullable()->comment('Масса всего груза в килограммах');
            $table->string('place_av_size')->nullable()->comment('Средний размер места длина*ширина*высота в мм');
            $table->string('waybill')->nullable()->comment('Накладная No');
            $table->string('downloading_info')->nullable()->comment('Информация по погрузке');
            $table->string('downloading_scheme')->nullable()->comment('Схема погрузки в jpg или pdf');
        //    $table->boolean('naval_downloading')->nullable()->comment('Загрузка навал');
            $table->boolean('pallet_downloading')->nullable()->comment('Загрузка на паллетах ');
        //    $table->string('oversize_downloading')->nullable()->comment('Загрузка негабарит (габариты 1-го места больше чем 1200*800*1000 и масса более 350 кг)');
            $table->boolean('additional_services')->nullable()->comment('Дополнительные услуги');
         //   $table->string('warming')->nullable()->comment('Утепление (1-4 слоя)');
         //   $table->string('plastic_film')->nullable()->comment('Полиэтиленовая плёнка (1-2 слоя)');
        //    $table->string('styrofoam')->nullable()->comment('Пенопласт 1200*2400*40 (Количество листов)');
        //    $table->string('hardboard')->nullable()->comment('Оргалит 1200*2400 Количество листов');
        //    $table->string('osb')->nullable()->comment('ОSB 2500*1250*9 Количество листов');
         //   $table->string('cardboard')->nullable()->comment('Картон 1200*2200 Количество листов');
            $table->boolean('knitting_wire_fixation')->nullable()->comment('Фиксация вязальной проволокой');
        //    $table->boolean('streych_film')->nullable()->comment('Стрейч плёнка');
        //    $table->boolean('crate')->nullable()->comment('Обрешётка');
        //    $table->boolean('evr_pallet')->nullable()->comment('Поддон EUR');
            $table->boolean('places_recalc')->nullable()->comment('Пересчёт мест');
            $table->boolean('inside_recalc')->nullable()->comment('Пересчёт внутри тарных вложений');
        //    $table->boolean('stickering')->nullable()->comment('Стикировка');
            $table->boolean('place_filling')->nullable()->comment('Пломбирование места');
            $table->boolean('unloading_photofix')->nullable()->comment('Фото фиксация + отчёт по выгрузке');
        //    $table->boolean('pallet_formation')->nullable()->comment('Формирование паллет 1200*800*1200');
            $table->boolean('assort_formatio')->nullable()->comment('Формирование ассортимента по параметрам');
            $table->boolean('consolid_t')->nullable()->comment('(t= +200C) Консолидация');
            $table->boolean('consolid_f')->nullable()->comment('(t= 0 +50C) Консолидация');
            $table->boolean('consolid_o')->nullable()->comment('(t= -180C) Консолидация');
            $table->boolean('downloading_photofix')->nullable()->comment('Фото фиксация + отчёт по загрузке');
            $table->boolean('van_filling')->nullable()->comment('Пломбирование фургона');
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
