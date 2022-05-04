<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForwardingReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forwarding_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->string('warming')->nullable()->comment('Утепление');
            $table->string('plastic_film')->nullable()->comment('Полиэтиленовая плёнка');
            $table->string('styrofoam')->nullable()->comment('Пенопласт 1200*2400*40');
            $table->string('hardboard')->nullable()->comment('Оргалит 1200*2400');
            $table->string('osb')->nullable()->comment('ОSB 2500*1250*9');
            $table->string('cardboard')->nullable()->comment('Картон 1200*2200');
            $table->string('streych_film')->nullable()->comment('Стрейч плёнка');

            $table->string('crate_photo')->nullable()->comment('Обрешётка');
            $table->boolean('crate_enabled')->nullable();

            $table->boolean('evr_pallet_enabled')->nullable()->comment('Поддон EVR');

            $table->string('places_recalculation')->nullable()->comment('Пересчёт мест');

            $table->string('internal_investments_recalculation')->nullable()->comment('Пересчёт внутритарных вложений');
            $table->string('internal_investments_recalculation_photo')->nullable();

            $table->string('stickering_photo')->nullable()->comment('Стикировка');
            $table->boolean('stickering_enabled')->nullable();

            $table->string('seat_filling_photo')->nullable()->comment('Пломбирование места');
            $table->boolean('seat_filling_enabled')->nullable();

            $table->string('pallet_formation_photo')->nullable()->comment('Формирование паллет');
            $table->boolean('pallet_formation_enabled')->nullable();

            $table->string('parameters_formation_photo')->nullable()->comment('Формирование ассортимента по параметрам');
            $table->boolean('parameters_formation_enabled')->nullable();

            $table->string('knitting_wire_fixation_photo')->nullable()->comment('Фиксация вязальной проволокой');
            $table->boolean('knitting_wire_fixation_enabled')->nullable();

            $table->string('sealing_van_photo')->nullable()->comment('Пломбирования фургона');
            $table->boolean('sealing_van_enabled')->nullable();

            $table->string('photofix_photo')->nullable()->comment('Фото фиксация');
            $table->boolean('photofix_enabled')->nullable();

            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forwarding_report');
    }
}
