<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table){
            $table->string('ogrn')->nullable();
            $table->string('leg_address')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('fact_address')->nullable();
            $table->string('signatory')->nullable();
            $table->string('fio')->nullable();
            $table->string('power_of_attorney')->nullable();
            $table->string('kpp')->nullable();
            $table->string('okpo')->nullable();
            $table->string('bank')->nullable();
            $table->string('bik')->nullable();
            $table->string('k_account')->nullable();
            $table->string('r_account')->nullable();

            $table->tinyInteger('regulation_1')->nullable()->comment('Подача контейнера под загрузку на склад указанный в заявке Клиента');
            $table->tinyInteger('regulation_2')->nullable()->comment('Перевозка груза со склада хранения на склад Экспедитора');
            $table->tinyInteger('regulation_3')->nullable()->comment('Перевозка железнодорожным транспортом');
            $table->tinyInteger('regulation_4')->nullable()->comment('Перевозка морским транспортом');
            $table->tinyInteger('regulation_5')->nullable()->comment('Консолидация груза на складе Экспедитора');

            $table->tinyInteger('regulation_6')->nullable()->comment('Приём груза на складе экспедитора с пересчётом мест');
            $table->tinyInteger('regulation_7')->nullable()->comment('Фото-фиксация принятого на склад Экспедитора груза');
            $table->tinyInteger('regulation_8')->nullable()->comment('Предоставление Клиенту отчёта о принятом на склад Экспедитора грузе');
            $table->tinyInteger('regulation_9')->nullable()->comment('Хранение груза на складе экспедитора');
            $table->tinyInteger('regulation_10')->nullable()->comment('Загрузка в контейнер с применением расходных материалов на основании заявки клиента');

            $table->tinyInteger('regulation_11')->nullable()->comment('Подача заявки 3-им лицам на предоставление крупнотоннажного контейнера');
            $table->tinyInteger('regulation_12')->nullable()->comment('Подача заявки 3-им лицам на предоставление вагона (платформы)');
            $table->tinyInteger('regulation_13')->nullable()->comment('Подача заявки 3-им лицам на предоставление контейнера-места в поезде');
            $table->tinyInteger('regulation_14')->nullable()->comment('Взаимодействие с государственными службами по заявке Клиента');
            $table->tinyInteger('regulation_15')->nullable()->comment('Ззаказ авто для вывоза контейнера до склада Клиента');

            $table->tinyInteger('regulation_16')->nullable()->comment('Перегрузка груза в другую(-ие) транспортное(-ые) средства');
            $table->tinyInteger('regulation_17')->nullable()->comment('Выставление контейнеров на площадку под загрузку');
            $table->tinyInteger('regulation_18')->nullable()->comment('Крановые работы для перемещения груза на погрузочной площадке Экспедитора');
            $table->tinyInteger('regulation_19')->nullable()->comment('Пересчёт мест в пункте назначения');
            $table->tinyInteger('regulation_20')->nullable()->comment('Стикировка мест');

            $table->tinyInteger('regulation_21')->nullable()->comment('Отслеживание транспортного средства на всём протяжении пути');
            $table->tinyInteger('regulation_22')->nullable()->comment('Предоставить представителю клиента рабочее место');
            $table->tinyInteger('regulation_23')->nullable()->comment('Обеспечить подборку груза на складе Экспедитора по параметрам клиента');
            $table->tinyInteger('regulation_24')->nullable()->comment('Замер груза (взвешивание, измерение объёма)');
        });

        Schema::table('client_contacts', function (Blueprint $table){
            $table->string('position')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
        });

        Schema::create('client_images_types', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('client_images', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->on('client_images_types')->references('id')->onDelete('cascade')->onUpdate('restrict');
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
        //
    }
}
