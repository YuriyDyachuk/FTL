<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForwardingAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forwarding', function (Blueprint $table){
            $table->dropColumn('warming_f');
            $table->dropColumn('warming_s');
            $table->dropColumn('warming_t');
            $table->dropColumn('warming_fth');
            $table->string('warming')->nullable()->comment('Утепление');
            $table->boolean('naval_downloading')->comment('Загрузка навал');
            $table->boolean('downloading_on_pallet')->comment('Загрузка на паллетах');
            $table->boolean('oversize_downloading')->comment('Загрузка негабарит');
            $table->boolean('knitting_wire_fixation')->comment('Фиксация вязальной проволокой');
            $table->boolean('inside_recalc')->nullable()->comment('Пересчёт внутри тарных вложений');
            $table->boolean('stickering')->comment('Стикировка');
            $table->dropColumn('filling');
            $table->boolean('place_filling')->nullable()->comment('Пломбирование места');
            $table->boolean('van_filling')->nullable()->comment('Пломбирование фургона');
            $table->boolean('unloading_photo_and_report')->comment('Фото фиксация + отчёт по выгрузке');
            $table->boolean('downloading_photo_and_report')->comment('Фото фиксация + отчёт по загрузке');
            $table->string('pallet_formation')->comment('Формирование паллет');
            $table->boolean('parameters_formation')->comment('Формирование ассортимента по параметрам');
            $table->string('consolidation')->comment('Консолидация');
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
