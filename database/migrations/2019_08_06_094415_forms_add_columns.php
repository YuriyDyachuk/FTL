<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormsAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function(Blueprint $table){
            $table->string('client')->nullable()->after('deadline_date');
        });
        Schema::table('client_requests', function(Blueprint $table){
            $table->dropColumn('client');
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('warehouse_request_getting', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('warehouse_request_container_downloading', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('warehouse_request_cross_docking', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
        Schema::table('car_request_from_train_station_to_client', function(Blueprint $table){
            $table->dropColumn('name');
            $table->date('downloading_date')->nullable()->comment('Дата погрузки')->after('id');
            $table->string('downloading_time')->comment('Время погрузки')->after('id');
            $table->string('downloading_contact')->comment('Контактное лицо на погрузке')->after('id');
            $table->string('downloading_contact_phone')->comment('Тел конт лица на погрузке')->after('id');
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки')->after('id');
            $table->string('unloading_time')->comment('Время выгрузки')->after('id');
            $table->string('unloading_contact')->comment('Контактное лицо на выгрузке')->after('id');
            $table->string('unloading_contact_phone')->comment('Тел конт лица на выгрузке')->after('id');
            $table->integer('status')->comment('Статус')->after('id');
            $table->string('notes')->comment('Примечания')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function(Blueprint $table){
            $table->dropColumn('client');
        });
        Schema::table('client_requests', function(Blueprint $table){
            $table->string('client')->comment('Клиент')->after('request_date');
        });
        Schema::table('car_request_pull_cargo_from_client_to_our_warehouse', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('car_request_pull_container_from_terminal_to_warehouse', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('warehouse_request_getting', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('warehouse_request_container_downloading', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('warehouse_request_cross_docking', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
        Schema::table('car_request_from_train_station_to_client', function(Blueprint $table){
            $table->dropColumn('downloading_date');
            $table->dropColumn('downloading_time');
            $table->dropColumn('downloading_contact');
            $table->dropColumn('downloading_contact_phone');
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_contact');
            $table->dropColumn('unloading_contact_phone');
            $table->dropColumn('status');
            $table->dropColumn('notes');
        });
    }
}
