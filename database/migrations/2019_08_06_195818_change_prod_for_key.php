<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProdForKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_products', function(Blueprint $table){
           // $table->dropForeign('lead_products_lead_id_foreign');
            $table->dropColumn('lead_id');
            $table->bigInteger('client_request_id')->unsigned();
            $table->foreign('client_request_id')->on('client_requests')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_products', function(Blueprint $table){
            $table->dropColumn('client_request_id');
            $table->bigInteger('lead_id')->unsigned();
            $table->foreign('lead_id')->on('leads')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }
}
