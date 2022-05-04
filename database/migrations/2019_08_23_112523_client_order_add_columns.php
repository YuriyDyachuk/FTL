<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientOrderAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('client_requests', function(Blueprint $table){
            $table->string('notes')->comment('Примечания');
        });
        Schema::table('leads', function(Blueprint $table){
            $table->string('railway_carriage_ktk_type')->comment('Тип ктк / вагон');
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
            $table->dropColumn('railway_carriage_ktk_type');
        });
        Schema::table('client_requests', function(Blueprint $table){
            $table->dropColumn('notes');
        });
    }
}
