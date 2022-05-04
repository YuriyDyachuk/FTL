<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarTmPrTrAddResponsibleColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_tm_pr_tr', function (Blueprint $table){
            $table->integer('responsible_chief_id')->unsigned()->nullable();
            $table->integer('responsible_branch_chief_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_tm_pr_tr', function (Blueprint $table){
            $table->dropColumn('responsible_chief_id');
            $table->dropColumn('responsible_branch_chief_id');
        });
    }
}
