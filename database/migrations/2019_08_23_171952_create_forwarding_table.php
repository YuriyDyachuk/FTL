<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forwarding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('warming_f')->nullable()->comment('Утепление 1 слой');
            $table->string('warming_s')->nullable()->comment('Утепление 2 слоя');
            $table->string('warming_t')->nullable()->comment('Утепление 3 слоя');
            $table->string('warming_fth')->nullable()->comment('Утепление 4 слоя');
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
            $table->string('places_calc_photo')->nullable()->comment('Фото для просчёта мест');
            $table->boolean('filling')->nullable()->comment('Пломбирование');
            $table->string('downloading_act_photo')->nullable()->comment('Скан акта погрузки');
            $table->string('forwarder_task')->nullable()->comment('Задание экспедитору');
            $table->string('pallet_size')->nullable()->comment('Размер палет при прогрузке');
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
        Schema::dropIfExists('forwarding');
    }
}
