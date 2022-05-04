<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGettingActCargoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('getting_act_cargo', function (Blueprint $table){
            $table->integer('client_id')->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('getting_act_id');
            $table->foreign('getting_act_id', 'getting_act_cargo-getting_act')->references('id')->on('getting_act')
                ->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('getting_act_cargo', function (Blueprint $table){
            $table->dropColumn('client_id');
            $table->dropColumn('status');
            $table->dropColumn('getting_act_id');
        });
    }
}
