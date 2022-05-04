<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignDatetimeAgentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_block', function (Blueprint $table){
            $table->integer('block_type');
            $table->unsignedBigInteger('block_id');
        });

        Schema::dropIfExists('agent_client_block');
        Schema::dropIfExists('agent_ftl_block');
        Schema::dropIfExists('agent_provider_block');
        Schema::dropIfExists('agent_terminal_block');
        Schema::dropIfExists('agent_train_block');

        ##########################################################

        Schema::table('datetime_block', function (Blueprint $table){
            $table->integer('block_type');
            $table->unsignedBigInteger('block_id');
        });

        Schema::dropIfExists('datetimes_clients');
        Schema::dropIfExists('datetimes_ftls');
        Schema::dropIfExists('datetimes_providers');
        Schema::dropIfExists('datetimes_trains');
        Schema::dropIfExists('datetimes_terminals');
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
