<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenewAllTables extends Migration
{
    public function up()
    {
        Schema::table('leads', function(Blueprint $table){
            $table->string('ktk_prefix')->comment('КТК префикс')->after('deadline_date');
            $table->string('ktk_number')->comment('КТК номер')->after('ktk_prefix');
        });
        Schema::create('client_requests', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->timestamp('request_date')->comment('Дата Заявки');
            $table->string('client')->comment('Клиент');
            $table->string('ktk_type')->comment('Тип КТК');
            $table->string('ktk_size')->comment('Размер КТК');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('lead_products', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('cargo')->comment('Груз');
            $table->string('weight')->comment('Масса, кг');
            $table->string('volume')->comment('Объём, м3');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('lead_product_download_types', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('download_type')->comment('Тип Загрузки');
            $table->string('pallet_size')->comment('Размер Паллет при погрузке');
            $table->string('pallets_amount')->comment('Кол-во Паллет');
            $table->string('places_amount')->comment('Кол-во мест');
            $table->timestamps();
            $table->foreign('product_id')->on('lead_products')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('car_request_pull_cargo_from_client_to_our_warehouse', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id', 'fk-car_request_pull_cargo-lead')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('car_request_pull_container_from_terminal_to_warehouse', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id', 'fk-car_request_pull_container-lead')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('warehouse_request_getting', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('warehouse_request_container_downloading', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('warehouse_request_cross_docking', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('warming')->comment('Утепление');
            $table->boolean('plastic_film')->comment('Полиэтиленовая плёнка');
            $table->boolean('styrofoam')->comment('Пенопласт 1200*2400*40');
            $table->boolean('hardboard')->comment('Оргалит 1200*2400');
            $table->boolean('osb')->comment('ОSB 2500*1250*9');
            $table->boolean('cardboard')->comment('Картон 1200*2200');
            $table->boolean('streych_film')->comment('Стрейч плёнка');
            $table->boolean('crate')->comment('Обрешётка');
            $table->boolean('evr_pallet')->comment('Поддон EVR');
            $table->boolean('tmc_unloading_on_pallets')->comment('Выгрузка ТМЦ на паллетах');
            $table->boolean('tmc_unloading_naval')->comment('Выгрузка ТМЦ навал');
            $table->boolean('tmc_unloading_oversize')->comment('Выгрузка ТМЦ негабарит');
            $table->boolean('places_recalculation')->comment('Пересчёт мест');
            $table->boolean('internal_investments_recalculation')->comment('Пересчёт внутритарных вложений');
            $table->boolean('stickering')->comment('Стикировка');
            $table->boolean('seat_filling')->comment('Пломбирование места');
            $table->boolean('unloading_photo_and_report')->comment('Фото фиксация + отчёт по выгрузке');
            $table->string('pallet_formation')->comment('Формирование паллет');
            $table->boolean('parameters_formation')->comment('Формирование ассортимента по параметрам');
            $table->boolean('first_tier_cargo_access_consolidation')->comment('Консолидация  доступ к грузу (1-й ярус)');
            $table->string('consolidation')->comment('Консолидация');
            $table->boolean('consolidation_in_an_open_area_without_security')->comment('Консолидация на открытой площадке без охраны');
            $table->boolean('naval_downloading')->comment('Загрузка навал');
            $table->boolean('downloading_on_pallet')->comment('Загрузка на паллетах');
            $table->boolean('oversize_downloading')->comment('Загрузка негабарит');
            $table->boolean('downloading_photo_and_report')->comment('Фото фиксация + отчёт по загрузке');
            $table->boolean('sealing_van')->comment('Пломбирования фургона');
            $table->string('railway_carriage_ktk_owner')->comment('Собственник КТК / вагона');
            $table->timestamps();
            $table->foreign('lead_id', 'fk-warehouse_request_forwarding-lead')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('car_request_from_warehouse_to_train_station', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('train_request', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('city_from')->comment('Город отправления');
            $table->string('station_from')->comment('Станция отправления');
            $table->string('downloading_address')->comment('Адрес погрузки');
            $table->date('downloading_date')->comment('Дата погрузки');
            $table->string('downloading_time')->comment('Время погрузки');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке');
            $table->string('city_to')->comment('Город прибытия');
            $table->string('station_to')->comment('Станция прибытия');
            $table->string('unloading_address')->comment('Адрес выгрузки');
            $table->date('unloading_date')->comment('Дата выгрузки');
            $table->string('unloading_time')->comment('Время выгрузки');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке');

            $table->timestamps();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('car_request_from_train_station_to_client', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('lead_id', 'fk-car_request_from_train-lead')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }


    public function down()
    {
        Schema::dropIfExists('car_request_from_train_station_to_client');
        Schema::dropIfExists('train_request');
        Schema::dropIfExists('car_request_from_warehouse_to_train_station');
        Schema::dropIfExists('warehouse_request_forwarding_container_downloading');
        Schema::dropIfExists('warehouse_request_cross_docking');
        Schema::dropIfExists('warehouse_request_container_downloading');
        Schema::dropIfExists('warehouse_request_forwarding_on_getting');
        Schema::dropIfExists('warehouse_request_getting');
        Schema::dropIfExists('car_request_pull_container_from_terminal_to_warehouse');
        Schema::dropIfExists('car_request_pull_cargo_from_client_to_our_warehouse');
        Schema::dropIfExists('lead_product_download_types');
        Schema::dropIfExists('lead_products');
        Schema::dropIfExists('client_requests');
        Schema::table('leads', function(Blueprint $table){
            $table->dropColumn(['ktk_prefix', 'ktk_number']);
        });
    }
}
