<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->date('photo_date')->nullable()->comment('Дата фотофиксации');
            $table->string('photo')->nullable()->comment('Фотофиксация');
            $table->boolean('photofix_enabled')->nullable()->comment('Фотофиксация включена');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->date('photo_date')->nullable()->comment('Дата фотофиксации');
            $table->string('photo')->nullable()->comment('Фотофиксация');
            $table->boolean('photofix_enabled')->nullable()->comment('Фотофиксация включена');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->dropColumn('photo_date');
            $table->dropColumn('photo');
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->dropColumn('photo_date');
            $table->dropColumn('photo');
        });
    }
}
