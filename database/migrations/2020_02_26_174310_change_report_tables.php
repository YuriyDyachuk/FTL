<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeReportTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('train_block_report');
        Schema::dropIfExists('client_block_report');
        Schema::dropIfExists('terminal_blocks_report');
        Schema::dropIfExists('ftl_blocks_report');
        Schema::dropIfExists('provider_blocks_report');
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
