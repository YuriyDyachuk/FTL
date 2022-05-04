<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlockFKey extends Migration
{
    private $blockTables = ['client_block', 'driver_block', 'ftl_block', 'heavy_rent_block', 'provider_block', 'spec_conds_block', 'terminal_block', 'train_block'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->blockTables as $blockTable) {
            Schema::table($blockTable, function (Blueprint $table){
                $table->unsignedBigInteger('order_id');
                $table->foreign('order_id')->on('order')->references('id')->onDelete('cascade')->onUpdate('restrict');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->blockTables as $blockTable) {
            Schema::table($blockTable, function (Blueprint $table){
                $table->dropColumn('order_id');
            });
        }
    }
}
