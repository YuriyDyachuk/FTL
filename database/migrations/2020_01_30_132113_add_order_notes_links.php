<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNotesLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_notes', function (Blueprint $table){
            $table->bigInteger('car_tm_pr_tr_id')->unsigned()->nullable();
            $table->foreign('car_tm_pr_tr_id')->on('car_tm_pr_tr')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_notes', function (Blueprint $table){
            $table->dropColumn('car_tm_pr_tr_id');
        });
    }
}
