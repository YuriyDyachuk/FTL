<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WarerstforwongtngAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->string('order_index')->nullable();
            $table->string('photofix_notes')->nullable()->comment('Для фотофиксации примечание');
            $table->boolean('warming_f')->nullable()->comment('Утепление 1 слой');
            $table->boolean('warming_s')->nullable()->comment('Утепление 2 слоя');
            $table->boolean('warming_t')->nullable()->comment('Утепление 3 слоя');
            $table->boolean('warming_fth')->nullable()->comment('Утепление 4 слоя');
            $table->boolean('plastic_film')->nullable()->comment('Полиэтиленовая плёнка');
            $table->boolean('styrofoam')->nullable()->comment('Пенопласт 1200*2400*40');
            $table->boolean('hardboard')->nullable()->comment('Оргалит 1200*2400');
            $table->boolean('osb')->nullable()->comment('ОSB 2500*1250*9');
            $table->boolean('cardboard')->nullable()->comment('Картон 1200*2200');
            $table->boolean('streych_film')->nullable()->comment('Стрейч плёнка');
            $table->boolean('crate')->nullable()->comment('Обрешётка');
            $table->boolean('evr_pallet')->nullable()->comment('Поддон EVR');
            $table->boolean('places_recalc')->nullable()->comment('Пересчёт количество мест');
            $table->string('downloading_photo')->nullable()->comment('Фотоотчёт с погрузки');
            $table->string('places_recalc_photo')->nullable()->comment('Фото для просчёта мест');
            $table->boolean('filling')->nullable()->comment('Пломбирование');
            $table->string('downloading_act_scan')->nullable()->comment('Скан акта погрузки');
            $table->string('forwarder_task')->nullable()->comment('Задание экспедитору');
            $table->string('pallet_size')->nullable()->comment('Размер палет при прогрузке');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->dropColumn('order_index');
            $table->dropColumn('photofix_notes');
            $table->dropColumn('warming_f');
            $table->dropColumn('warming_s');
            $table->dropColumn('warming_t');
            $table->dropColumn('warming_fth');
            $table->dropColumn('plastic_film');
            $table->dropColumn('styrofoam');
            $table->dropColumn('hardboard');
            $table->dropColumn('osb');
            $table->dropColumn('cardboard');
            $table->dropColumn('streych_film');
            $table->dropColumn('crate');
            $table->dropColumn('evr_pallet');
            $table->dropColumn('places_recalc');
            $table->dropColumn('downloading_photo');
            $table->dropColumn('places_recalc_photo');
            $table->dropColumn('filling');
            $table->dropColumn('downloading_act_scan');
            $table->dropColumn('forwarder_task');
            $table->dropColumn('pallet_size');
        });
    }
}
