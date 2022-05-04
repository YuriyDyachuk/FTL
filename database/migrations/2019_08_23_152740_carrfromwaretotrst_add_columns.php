<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarrfromwaretotrstAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $table){
            $table->boolean('forwarding_enabled')->nullable();
            $table->string('order_index')->nullable()->comment('Индекс заявки');
            $table->string('for_client')->nullable()->comment('Для клиента');
            $table->string('downloading_address_f')->nullable()->comment('Адрес погрузки 1');
            $table->string('ktk_staging')->nullable()->comment('Постановка КТК');
            $table->string('recipient')->nullable()->comment('Получатель');
            $table->string('unloading_address')->nullable()->comment('Адрес выгрузки');
            $table->string('ktk_delivery')->nullable()->comment('Сдача КТК');
            $table->string('downloading_address_s')->nullable()->comment('Адрес погрузки 2');
            $table->string('downloading_address_t')->nullable()->comment('Адрес погрузки 3');
            $table->string('car_type')->nullable()->comment('Вид авто (тент/реф/терм/борт/КТК)');
            $table->string('downloading_method')->nullable()->comment('Способ погрузки (бок/верх/палет/навал)');
            $table->string('ktk_staging_terminal')->nullable()->comment('Терминал постановки КТК');
            $table->string('spec_conds_for_sec_cargo')->nullable()->comment('Особые условия крепления груза');
            $table->string('spec_conds_for_trans_cargo')->nullable()->comment('Особые условия транспортировки груза');
            $table->string('spec_conds_for_insul_ktk')->nullable()->comment('Особые условия утепления КТК');
            $table->string('spec_cond_cush_material')->nullable()->comment('Особые условия прокладочный материал');
            $table->string('spec_cond_loading_by_proxy')->nullable()->comment('Особые условия погрузка по доверенности');
            $table->string('temp_mode')->nullable()->comment('Температурный режим Перевозки');
            $table->string('recomm_cost')->nullable()->comment('Рекомендуемая стоимость рейса');
            $table->string('driver_fio')->nullable()->comment('ФИО Водителя');
            $table->string('driver_passport_data')->nullable()->comment('Паспортные данные водителя');
            $table->string('number_and_date_of_vu_delivery')->nullable()->comment('Номер и дата выдачи ВУ');
            $table->string('mark_and_number_of_car')->nullable()->comment('Марка и номер машины');
            $table->string('trailer_num')->nullable()->comment('Номер прицепа');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_request_from_warehouse_to_train_station', function(Blueprint $table){
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('order_index');
            $table->dropColumn('for_client');
            $table->dropColumn('downloading_address_f');
            $table->dropColumn('ktk_staging');
            $table->dropColumn('recipient');
            $table->dropColumn('unloading_address');
            $table->dropColumn('ktk_delivery');
            $table->dropColumn('downloading_address_s');
            $table->dropColumn('downloading_address_t');
            $table->dropColumn('car_type');
            $table->dropColumn('downloading_method');
            $table->dropColumn('ktk_staging_terminal');
            $table->dropColumn('spec_conds_for_sec_cargo');
            $table->dropColumn('spec_conds_for_trans_cargo');
            $table->dropColumn('spec_conds_for_insul_ktk');
            $table->dropColumn('spec_cond_cush_material');
            $table->dropColumn('spec_cond_loading_by_proxy');
            $table->dropColumn('temp_mode');
            $table->dropColumn('recomm_cost');
            $table->dropColumn('driver_fio');
            $table->dropColumn('driver_passport_data');
            $table->dropColumn('number_and_date_of_vu_delivery');
            $table->dropColumn('mark_and_number_of_car');
            $table->dropColumn('trailer_num');
        });
    }
}
