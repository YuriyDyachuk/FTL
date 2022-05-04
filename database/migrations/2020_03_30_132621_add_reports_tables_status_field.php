<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsTablesStatusField extends Migration
{
    private $reportTables = ['car_point_report', 'driver_report', 'forwarding_report', 'heavy_rent_report', 'power_of_attorney_report', 'route_track_report', 'train_report', 'waybill_report'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->reportTables as $reportTable) {
            Schema::table($reportTable, function(Blueprint $table){
                $table->integer('status')->default(\App\Models\Entities\EntityStatus::NEW_STATUS);
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
        foreach ($this->reportTables as $reportTable) {
            Schema::table($reportTable, function(Blueprint $table){
                $table->dropColumn('status');
            });
        }
    }
}
