<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function(Blueprint $table){
            $table->string('railway_carriage_ktk_owner')->nullable()->comment('Собственник КТК / вагона');
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->dropColumn('railway_carriage_ktk_owner');
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
            $table->dropColumn('railway_carriage_ktk_owner');
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->string('railway_carriage_ktk_owner')->nullable()->comment('Собственник КТК / вагона');
        });
    }
}
