<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('train_request', function(Blueprint $table){
            $table->string('notes')->nullable()->comment('Примечания');
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->string('notes')->nullable()->comment('Примечания');
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
            $table->dropColumn('notes');
        });
        Schema::table('warehouse_request_forwarding_container_downloading', function(Blueprint $table){
            $table->dropColumn('notes');
        });
    }
}
