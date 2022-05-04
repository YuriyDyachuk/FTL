<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForwardingAddFkColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_request_cross_docking', function(Blueprint $table){
            $table->dropColumn('order_id');
            $table->string('order_index')->nullable();
        });
        Schema::table('warehouse_request_forwarding_on_getting', function(Blueprint $table){
            $table->boolean('forwarding_enabled')->nullable()->comment('Экспедирование');
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
