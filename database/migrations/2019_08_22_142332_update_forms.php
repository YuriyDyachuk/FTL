<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('train_request', function(Blueprint $table){
            $table->string('index')->nullable();
            $table->boolean('forwarding_enabled')->nullable()->comment('Экспедирование');
            $table->string('recipient')->nullable()->comment('Получатель');
            $table->string('recipient_inn')->nullable()->comment('ИНН получателя');
            $table->string('ktk_staging_terminal')->nullable()->comment('Терминал постановки КТК');
            $table->string('spec_conds_for_sec_cargo')->nullable()->comment('Особые условия крепления груза');
            $table->string('spec_conds_for_trans_cargo')->nullable()->comment('Особые условия транспортировки груза');
            $table->string('spec_conds_for_insul_ktk')->nullable()->comment('Особые условия утепления КТК');
            $table->string('spec_cond_cush_material')->nullable()->comment('Особые условия прокладочный материал');
            $table->string('spec_cond_loading_by_proxy')->nullable()->comment('Особые условия погрузка по доверенности');
            $table->string('temp_mode')->nullable()->comment('Температурный режим');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('train_request', function(Blueprint $table){
            $table->dropColumn('index');
            $table->dropColumn('forwarding_enabled');
            $table->dropColumn('recipient');
            $table->dropColumn('recipient_inn');
            $table->dropColumn('ktk_staging_terminal');
            $table->dropColumn('spec_conds_for_sec_cargo');
            $table->dropColumn('spec_conds_for_trans_cargo');
            $table->dropColumn('spec_conds_for_insul_ktk');
            $table->dropColumn('spec_cond_cush_material');
            $table->dropColumn('spec_cond_loading_by_proxy');
            $table->dropColumn('temp_mode');
        });
    }
}
