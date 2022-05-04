<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientRequestsFromToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_request_from_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('client_request_from_id')->unsigned();
            $table->timestamps();
            $table->foreign('client_request_from_id')->on('client_request_from')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('client_request_to_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('client_request_to_id')->unsigned();
            $table->timestamps();
            $table->foreign('client_request_to_id')->on('client_request_to')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_request_from_contacts');
        Schema::dropIfExists('client_request_to_contacts');
    }
}
