<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCleadsClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads_clients', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('client_id');
            $table->unique(['lead_id', 'client_id']);
            $table->foreign('lead_id')->references('id')->on('leads')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads_clients');
    }
}
