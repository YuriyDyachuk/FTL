<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForwardingAddNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forwarding', function (Blueprint $table){
            $table->tinyInteger('styrofoam_fact')->nullable();
            $table->tinyInteger('hardboard_fact')->nullable();
            $table->tinyInteger('osb_fact')->nullable();
            $table->tinyInteger('cardboard_fact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forwarding', function (Blueprint $table){
            $table->dropColumn('styrofoam_fact');
            $table->dropColumn('hardboard_fact');
            $table->dropColumn('osb_fact');
            $table->dropColumn('cardboard_fact');
        });
    }
}
