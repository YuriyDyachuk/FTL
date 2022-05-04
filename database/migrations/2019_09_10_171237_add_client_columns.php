<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_requests', function(Blueprint $table){
            $table->date('unloading_date')->nullable()->comment('Дата выгрузки');
            $table->boolean('unloading_time_is_interval')->nullable();
            $table->string('unloading_time')->nullable();
            $table->string('unloading_time_from')->nullable();
            $table->string('uloading_time_to')->nullable();
            $table->string('unloading_on')->nullable()->comment('Загрузка на');
            $table->string('ktk_prefix')->nullable();
            $table->string('ktk_number')->nullable();
            $table->string('ktk_owner_name')->nullable();
            $table->string('ktk_owner_inn')->nullable();
            $table->boolean('client_has_container')->nullable();
            $table->string('client_container_place')->nullable();
            $table->string('tm_name')->nullable();
            $table->string('tm_code')->nullable();
            $table->string('tm_city')->nullable();
            $table->string('tm_address')->nullable();
            $table->string('tm_power_of_attorney_number')->nullable();
            $table->string('tm_power_of_attorney_scan')->nullable();
            $table->string('tr_name')->nullable();
            $table->string('tr_code')->nullable();
            $table->string('tr_address')->nullable();
            $table->boolean('warming')->nullable();
            $table->boolean('forwarding_enabled')->nullable()->comment('Экспедирование');
            $table->unsignedBigInteger('forwarding_id')->nullable();
        });
        Schema::table('client_request_from', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_request_id');
            $table->integer('type')->nullable()->comment('Тип отправления');
            $table->string('city')->nullable()->comment('Город');
            $table->string('name')->nullable()->comment('Наименование');
            $table->string('code')->nullable()->comment('Код');
            $table->string('address')->nullable()->comment('Адрес');
            $table->string('contact_name')->nullable()->comment('Имя конт лица');
            $table->string('contact_phone')->nullable()->comment('Телефон конт лица');
            $table->timestamps();
            $table->foreign('client_request_id')->on('client_requests')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::create('client_request_to', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_request_id');
            $table->integer('type')->nullable()->comment('Тип отправления');
            $table->string('city')->nullable()->comment('Город');
            $table->string('name')->nullable()->comment('Наименование');
            $table->string('code')->nullable()->comment('Код');
            $table->string('address')->nullable()->comment('Адрес');
            $table->string('contact_name')->nullable()->comment('Имя конт лица');
            $table->string('contact_phone')->nullable()->comment('Телефон конт лица');
            $table->timestamps();
            $table->foreign('client_request_id')->on('client_requests')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_request_to');
        Schema::dropIfExists('client_request_from');
        Schema::table('client_requests', function(Blueprint $table){
            $table->dropColumn('unloading_date');
            $table->dropColumn('unloading_time_is_interval');
            $table->dropColumn('unloading_time');
            $table->dropColumn('unloading_time_from');
            $table->dropColumn('uloading_time_to');
            $table->dropColumn('unloading_on');
            $table->dropColumn('ktk_prefix');
            $table->dropColumn('ktk_number');
            $table->dropColumn('ktk_owner_name');
            $table->dropColumn('ktk_owner_inn');
            $table->dropColumn('client_has_container');
            $table->dropColumn('client_container_place');
            $table->dropColumn('tm_name');
            $table->dropColumn('tm_code');
            $table->dropColumn('tm_city');
            $table->dropColumn('tm_address');
            $table->dropColumn('tm_power_of_attorney_number');
            $table->dropColumn('tm_power_of_attorney_scan');
            $table->dropColumn('tr_name');
            $table->dropColumn('tr_code');
            $table->dropColumn('tr_address');
            $table->dropColumn('warming');
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('forwarding_id');
        });
    }
}
