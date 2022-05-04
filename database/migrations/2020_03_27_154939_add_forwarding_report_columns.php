<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForwardingReportColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forwarding_report', function (Blueprint $table){
            $table->string('styrofoam_count')->nullable();
            $table->string('hardboard_count')->nullable();
            $table->string('osb_count')->nullable();
            $table->string('cardboard_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forwarding_report', function (Blueprint $table){
            $table->dropColumn('styrofoam_count');
            $table->dropColumn('hardboard_count');
            $table->dropColumn('osb_count');
            $table->dropColumn('cardboard_count');
        });
    }
}
